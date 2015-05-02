<?php
/*
Copyright (c) 2015 Takaaki Masaki
Released under the MIT license
http://opensource.org/licenses/mit-license.php
*/
class rel2Abs{

	function html( $baseurl, $ua = '' ){
		/*
		$baseurl = filter_input(INPUT_GET,'url');
		$ua = filter_input(INPUT_GET,'userAgent');
		*/
		$this->baseurl = $baseurl;
		$options = array(
		  'http' => array(
		    'method' => 'GET',
		    'header' => 'User-Agent: '.$ua,
		  ),
		);

		$context = stream_context_create($options);
		$html = file_get_contents($baseurl, false, $context);
		return preg_replace_callback('#((href|src)\s*=\s*)("[^\":^\\"]*"|\'[^\":^\\\']*\')#', array($this, 'preg'), $html );

	}
	function url($baseurl, $rel){
		return $this->createUri($baseurl, '', $rel);
	}
	function preg($m){
		return $this->createUri($this->baseurl, $m[1], $m[3]);
	}

	function createUri( $base = '', $pre='', $relational_path = '' ) {
		if (strpos($relational_path, '\'') !== FALSE){
			$quote = '\'';
		}else{
			$quote = '"';
		}
	        $relational_path = trim($relational_path, '\'\"');
		$parse = array (
			'scheme' => null,
			'host' => null,
			'path' => null,
		);
		$parse = parse_url ( $base );
		
		if ( strpos( $parse['path'], '/', ( strlen( $parse['path'] ) - 1 ) ) !== FALSE ) {
			$parse['path'] .= '.';
		}
		if ( strpos( $relational_path, ':' ) !== FALSE ) {
			return $pre. $quote. $relational_path. $quote;
		}
		elseif( strpos( $relational_path, '//' ) !== FALSE ){
			return $pre. $quote.'http:'. $relational_path. $quote;
		}
		elseif ( preg_match ( "#^/.*$#", $relational_path ) ) {
			$basePath = explode ( '/', dirname ( $parse ['path'] ) );
			$path = str_replace("\\", "", implode("/", $basePath));
			return $pre. $quote.$parse['scheme'] . '://' . $parse ['host'] .$path. $relational_path. $quote;
		} else {
			$basePath = explode ( '/', dirname ( $parse ['path'] ) );
			$relPath = explode ( '/', $relational_path );
			foreach ( $relPath as $relDirName ) {
				if ($relDirName == '.') {
					array_shift ( $basePath );
					array_unshift ( $basePath, '' );
				} elseif ($relDirName == '..') {
					array_pop ( $basePath );
					if ( count ( $basePath ) == 0 ) { $basePath = array( '' ); }
				} else {
					array_push ( $basePath, $relDirName );
				}
			}
			$path = str_replace("\\", "", implode("/", $basePath));
			return $pre. $quote. $parse ['scheme']. '://'. $parse ['host'] .$path .$quote;

		}
	}
}
