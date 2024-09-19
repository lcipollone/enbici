<?php

	class Valores{
		public static function getOperatorias()
		{
			$sqlconn = new db();
			try {
		    	$sqlconn->connect();
				$result = $sqlconn->execute('EXEC sp_Operatorias_LIST ', null, $errorInfo);
				if (!$result) {
					throw new Exception ($errorInfo);
				}
				return $result;
			} catch (Exception $e) {
		        throw new Exception ($errorInfo);
		        die();
		    }

			$sqlconn->free();
			$sqlconn->disconnect();
		}

		public static function getEmpresas($nombre)
		{
			$sqlconn = new db();
			try {
		    	$sqlconn->connect();
				$result = $sqlconn->execute("EXEC sp_Empresas_LIST ? ", $nombre, $errorInfo);
				if (!$result) {
					throw new Exception ($errorInfo);
				}
				return $result;
		    } catch (Exception $e) {
		        throw new Exception ($errorInfo);
		        die();
		    }

			$sqlconn->free();
			$sqlconn->disconnect();
		}

		public static function getValores($idOperatoria)
		{
			$sqlconn = new db();
			try {
		    	$sqlconn->connect();
				$result = $sqlconn->execute('EXEC sp_ValoresOperatorias_LIST ?', $idOperatoria, $errorInfo);
				if (!$result) {
					//echo $errorInfo;
					throw new Exception ($errorInfo);
				}
				return $result;
		    } catch (Exception $e) {
		        throw new Exception ($errorInfo);
		        die();
		    }

			$sqlconn->free();
			$sqlconn->disconnect();
		}
	}

?>