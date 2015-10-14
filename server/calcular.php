<?php

if (isset($_POST["salary"])){
	$salary = $_POST["salary"];

	//Calculo INSS
	$inss = 0;
	if ($salary <= 1399.12){
		$inss = ($salary / 100) * 8;
	}
		else if ($salary > 1399.12 && $salary <= 2331.88){
			$inss = ($salary / 100) * 9;
		}
			else if ($salary > 2331.88 && $salary <= 4663.75){
				$inss = ($salary / 100) * 11;
			}
				else {
					$inss = 513.02;
				}

	//Calculo IRPF
	$irpf = $salary - $inss;

	if ($irpf <= 1903.98){
		$irpf = 0;
	}
		else if ($irpf > 1903.98 && $irpf <= 2826.65){
			$irpf = (($irpf / 100) * 7.5) - 142.80;
		}
			else if ($irpf > 2826.65 && $irpf <= 3751.05){
				$irpf = (($irpf / 100) * 15) - 354.80;
			}
				else if ($irpf > 3751.05 && $irpf <= 4664.68){
					$irpf = (($irpf / 100) * 22.5) - 636.13;
				}
					else {
						$irpf = (($irpf / 100) * 27.5) - 869.36;
					}

	$return['line_0'] = $inss;
	$return['line_1'] = $irpf;
	$return['line_2'] = ($salary - $inss) - $irpf;

	echo json_encode($return);
}

?>