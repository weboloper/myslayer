<?php

namespace Components\Library\Volt;

class VoltFunctions
{
    /**
     * Compile any function call in a template
     *
     * @param string $name      function name
     * @param mixed  $arguments function args
     *
     * @return string compiled function
     */
    public function compileFunction($name, $arguments)
    {
        if (function_exists($name)) {
            return $name . '(' . $arguments . ')';
        }

        switch ($name) {
            case 'is_authorized':
                return '$this->auth->isAuthorizedVisitor()';
            case 'is_moderator':
                return '$this->auth->isModerator()';
            case 'is_admin':
                return '$this->auth->isAdmin()';
            case 'teaser':
                return Functions\Teaser::class . "::create({$arguments})";
            case 'vote_score':
                return 'container(' . Service\Vote::class . "::class)->getScore({$arguments})";
        }

        $property = $name;
        $class = '\Components\Library\Volt\ZFunction';
        if (method_exists($class, $property)) {
            return $class . '::' . $property . '(' . $arguments . ')';
        }
        if (!$arguments) {
            // Get constant if exist
            if (defined($class . '::' . $property)) {
                return $class . '::' . $property;
            }
            // Get static property if exist
            if (property_exists($class, $property)) {
                return $class . '::$' . $property;
            }
        }

        return null;
    }

    /**
     * Compile some filters
     *
     * @param string $name      The filter name
     * @param mixed  $arguments The filter args
     *
     * @return string|null
     */
    public function compileFilter($name, $arguments)
    {
        switch ($name) {
            case 'isset':
                return '(isset(' . $arguments . ') ? ' . $arguments . ' : false)';
            case 'long2ip':
                return 'long2ip(' . $arguments . ')';
            // case 'teaser':
            //     return Functions\Teaser::class . '::create(' . $arguments . ')';
            // case 'strlen':
            //     return "\\Stringy\\create('$arguments')->length()";
        }

        return null;
    }
}