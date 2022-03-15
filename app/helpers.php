<?php


/**
 * Remove element from array based on key
 *
 * @param  Array  $array
 * @param  Array  $keys
 *
 * @return array
 */
if (! function_exists('array_remove_element')) {

	function array_remove_element($array=[], $keys=[]) {

        return array_diff_key($array, array_flip((array) $keys));  
    }
}


/**
 * Generate the ids array from a array of hash ids
 *
 * @param  mixed<int|string|array> $id
 * @return mixed<String|Array>
 */
if ( ! function_exists('decode_hashids') ) {

	function decode_hashids($hashids) {

		if ( is_numeric($hashids) || is_string($hashids) ) {

			return decode_hashid($hashids);
		}

		if ( is_array($hashids) && !empty($hashids) ) {

			$ids = [];

			foreach ($hashids as $key => $hashid) {
				$ids[$key] = decode_hashid($hashid);
			}

			return $ids;
		}

		return $hashids;
	}
}


/**
 * Generate the id string of a given hash id string
 *
 * @param  mixed<int|string> $id
 * @return String
 */
if ( ! function_exists('decode_hashid') ) {

	function decode_hashid($hashid = null) {

		if ( ! $hashid ) { return null; }

		if ( config('hasher.security.ramdomize') ) {

            $hash = substr($hashid, 0, (int)config('hasher.security.padding') * (-1) );
        }

        $id = (new \Hashids\Hashids('', config('hasher.padding')))->decode($hash)[0] ?? $hashid;

		return $id;
	}
}
