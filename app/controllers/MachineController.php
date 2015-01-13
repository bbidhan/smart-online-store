<?php

class MachineController extends BaseController {

	public function custseg()
	{
		
        return View::make('admin.custseg')
			->withMenu(7)
			;
	}	
	public function busiexp()
	{
		$population = Input::get('population');
		if ($population==null) {
			$population = 1000;
		}
		// $vals = explode(" ", "1.0 -1.15332379 -1.12029693 -1.056686 -0.98690553 -0.92213829 -0.86575855 -0.81765416 -0.7765702 -0.74112738 -0.71016594 -0.68280274 -0.65838968 -0.63645273 -0.61663879 -0.59867669 -0.58235059 -0.56748279 -0.5539227 -0.5415399 -0.53021969 -1.15332379 -1.1467739 -1.13989275 -1.13547349 -1.13249787 -1.13037679 -1.12879379 -1.12756913 -1.12659435 -1.12580044 -1.12514154 -1.12458602 -1.12411139 -1.12370122 -1.12334325 -1.12302811 -1.12274857 -1.12249892 -1.12227462 -1.122072");
		$vals = explode(" ","6.31141322e+07 3.44545932e+03");
  //       $result = $vals[0];
  //       for ($i=1; $i <= 20; $i++) { 
  //       	$result+= $vals[$i] * pow($population,$i);
  //       }
		// for ($i=1; $i <= 20; $i++) { 
  //       	$result+= $vals[$i+20-1] * pow($population,(1/$i));
  //       }
  //       return $result;

		$profit =  $vals[0] + $population * $vals[1];

        return View::make('admin.busiexp')
			->withProfit($profit)
			->withPopulation($population)
			->withMenu(8)
			;
	}
}