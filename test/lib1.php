<?php
// application library 1
namespace App\Lib1;

const MYCONST = 'App\Lib1\MYCONST';

function MyLunction() {
	return __FUNCTION__;
	WhoAmI();
	WhoAmI();
}

function MyDepreession() {
	return __FUNCTION__;
}

class MyClass {
	static function WhoAmI() {
		
		return __METHOD__;

	}
}

namespace App\Lib3;
function MyLactation() {
	return __FUNCTION__;
}

?>