<?php

namespace TechStory\Classes\Validation;


interface ValidationRule
{
    public function check(string $name, $value);
}
