<?php
/* Copyright (c) 1998-2019 ILIAS open source, Extended GPL, see docs/LICENSE */

/**
 * @author  Niels Theen <ntheen@databay.de>
 */
function toList() {
	global $DIC;

	$language = $DIC->language();
	$dataFactory = new ILIAS\Data\Factory();
	$validationFactory = new \ILIAS\Refinery\Validation\Factory($dataFactory, $language);

	$factory = new ILIAS\Refinery\BasicFactory($validationFactory);

	$transformation = $factory->kindlyTo()->listOf(new \ILIAS\Refinery\KindlyTo\Transformation\IntegerTransformation());

	$result = $transformation->transform(array(5, '1', 4.3));

	return assert(array(5, 1, 4) === $result);
}
