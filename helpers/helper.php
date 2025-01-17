<?php 
		//funcion especial para formatear arrays mas legibles o objetos mui utiles
		function formatData($data) {
			echo "<pre>";
			
			// Verifica si es un array
			if (is_array($data)) {
				echo "Array:\n";
				foreach ($data as $key => $value) {
					echo "[$key]\t=> $value\n";
				}
			}
			// Verifica si es un objeto
			elseif (is_object($data)) {
				echo "Object (" . get_class($data) . "):\n";
				$objectVars = (array) $data; // Convierte el objeto a un array
				foreach ($objectVars as $key => $value) {
					if (is_object($value)) {
						echo "[$key]\t=> Object (" . get_class($value) . ")\n";
					} elseif (is_array($value)) {
						echo "[$key]\t=> Array (" . count($value) . " items)\n";
					} else {
						echo "[$key]\t=> $value\n";
					}
				}
			}
			// Otros tipos de datos
			else {
				echo "Value:\n$data\n";
			}
		
			echo "</pre>";
		}
?>