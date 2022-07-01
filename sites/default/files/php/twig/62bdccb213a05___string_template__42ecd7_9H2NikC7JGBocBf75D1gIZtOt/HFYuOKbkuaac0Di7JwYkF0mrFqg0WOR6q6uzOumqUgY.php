<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* __string_template__42ecd771ea4932881cdd69f36c0340fc9f77106b8e3652c5df9c04dec7f61e02 */
class __TwigTemplate_9513c6273e8306ea5a056c97ed27e37bf8f7ed3b5439ce8fa97205555fa3f578 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class='menu'>
      <ul class='menu-list  ' >
            <li class='menu-item' ><a href='/node/add/document' class=\"mt-button\">Ajouter un document</a></li>
            <li class='menu-item' ><a href='/node/add/projet' class=\"mt-button\" >Ajouter un projet</a></li>
\t    <li class='menu-item' ><a href='/node/add/article' class=\"mt-button\" >Ajouter une actualité</a></li>
      </ul>
</div>";
    }

    public function getTemplateName()
    {
        return "__string_template__42ecd771ea4932881cdd69f36c0340fc9f77106b8e3652c5df9c04dec7f61e02";
    }

    public function getDebugInfo()
    {
        return array (  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "__string_template__42ecd771ea4932881cdd69f36c0340fc9f77106b8e3652c5df9c04dec7f61e02", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array();
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                [],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
