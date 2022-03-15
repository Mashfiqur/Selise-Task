<?php

namespace App\Concerns\Models;

use Hashids\Hashids;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

trait IdHashable {

	/**
     * hash id field column name
     *
     * @var string
     */
	public $hashIdFieldName;


	/**
     * minimum char length of hash id
     *
     * @var int
     */
	public $hashPaddingLength;


	/**
     * extra padding length of hash id
     *
     * @var int
     */
	public $hashRandomizePadingLength;


	/**
     * should randomize hash ids by adding extra padding
     *
     * @var boolean
     */
	public $hashRandomize;


	/**
     * Attach event name on which hash id will be added to model object
     *
     * @var string
     */
	public $idHashableAttachEvent;

	
	/**
     * Model user relation attach after action
     *
     * @var array
     */
	public $idHashableSaveActionForEvents;


    /**
     * Get the original auto incrementing id column value if need
     *
     * @return mixed<int|string>
     */
	public function getId() {

        return $this->attributes['id'];
    }


    /**
     * Get the hash id
     *
     * @return string
     */
	public function getHashId() {

        if ( ! config('hasher.enable') ) {

            return $this->id;
        }

        return $this->attributes['hash_id'];
    }


    /**
     * Get the original id extracted from hash id
     *
     * @return string
     */
    public function getOriginalIdFromHashId() {

    	if ( $this->hashRandomize ) {
    		$hashId = substr(
	    		$this->getHashId(), 
	    		0, 
	    		$this->hashRandomizePadingLength * (-1)
    		);
    	}
    	
    	return (new Hashids('', $this->hashPaddingLength))->decode($hashId)[0] ?? null;
    }


    /**
     * Replace the auto increament id attribute by generated hash id on resource pulling
     *
     * @param  $value mixed<int|string>
     * @return string
     */
    /*
    public function getIdAttribute($value) {

        return $this->hash_id ?? $value;
    }
    */

	
	/**
     * Attach hash id to model object
     *
     * @return void
     */
	public static function bootIdHashable() {

        $self = new self;

		$self->initializeIdHashable();

		static::{$self->idHashableAttachEvent}(function($model) use ($self) {
            
            $hashIdFieldName  = $self->getHashIdFieldName();
            
            if ( Schema::hasColumn($model->getTable(), $hashIdFieldName) ) {
				
				$model->{$hashIdFieldName}
					?: $model->{$hashIdFieldName} = $self->generateHashId($model->getId());

				! in_array($self->idHashableAttachEvent, $self->idHashableSaveActionForEvents)
					?: $model->save();
			}
        });
	}

	/**
     * Get the hash id column field name
     *
     * @return string
     */
	public function getHashIdFieldName() {
        
        return $this->hashIdFieldName;
    }


    /**
     * Generate hash id string
     *
     * @param  mixed<int|string> $id
     * @return string
     */
    public function generateHashId($id) {

    	$hashId = (new Hashids('', $this->hashPaddingLength))->encode($id);

    	if ( $this->hashRandomize ) {
			$hashId = $hashId . Str::random($this->hashRandomizePadingLength);
    	}
    	
        return $hashId;
    }


    /**
     * constarin result by hash id
     *
     * Local Scope Implementation
     *
     * @param  Builder  $builder
     * @param  String   $hashId
     *
     * @return Builder
     */
    public function scopeByHashId(Builder $builder, $hashId) {

        return $builder->where($this->getHashIdFieldName(), $hashId);
    }


    /**
     * Return matching model object by hash id
     *
     * @param  String   $hashId
     * @return object
     */
    public static function findByHashId($hashId) {
        
        return static::byHashId($hashId)->firstOrFail();
    }


    /**
     * Get user over written configs if provided
     *
     * @return void
     */
	protected function initializeIdHashable() {

		$mapedValues = method_exists($this, 'idHahsable')
					       ? $this->idHahsable()
			       		   : [];

		$this->hashIdFieldName  			  = $mapedValues['column'] 				  ?? config('hasher.column');
		$this->hashPaddingLength 			  = $mapedValues['padding'] 			  ?? config('hasher.padding');
		$this->hashRandomizePadingLength 	  = $mapedValues['security']['padding']   ?? config('hasher.security.padding');
		$this->hashRandomize 				  = $mapedValues['security']['ramdomize'] ?? config('hasher.security.ramdomize');
		$this->idHashableAttachEvent   		  = $mapedValues['event']['attach'] 	  ?? config('hasher.event.attach');
		$this->idHashableSaveActionForEvents  = $mapedValues['event']['save'] 		  ?? config('hasher.event.save');
	}
}