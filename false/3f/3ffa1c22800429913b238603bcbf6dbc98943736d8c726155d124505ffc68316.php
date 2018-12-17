<?php

/* layout.twig */
class __TwigTemplate_271c6b9e9c364be8e46fab2dee11ee41a7f210cc6d3ba47bbf258037e244de4b extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<head>
    <meta charset=\"utf-8\">
    <title>La bonne adresse</title>
</head>
<body>
    ";
        // line 7
        $this->displayBlock('content', $context, $blocks);
        // line 8
        echo "</body>";
    }

    // line 7
    public function block_content($context, array $blocks = array())
    {
        echo " ";
    }

    public function getTemplateName()
    {
        return "layout.twig";
    }

    public function getDebugInfo()
    {
        return array (  38 => 7,  34 => 8,  32 => 7,  24 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout.twig", "C:\\wamp\\www\\la bonne adresse\\templates\\layout.twig");
    }
}
