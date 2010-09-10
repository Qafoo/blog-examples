<?php

class qaInvalidArgumentException extends InvalidArgumentException
{
    public function __construct($argumentName, $argumentValue, $expected)
    {
        parent::__construct(
            sprintf(
                "Invalid value '%s' for argument %s, expected %s.",
                ( is_scalar( $argumentValue ) ? $argumentValue : gettype( $argumentValue ) ),
                $argumentName,
                $expected
            )
        );
    }
}

?>
