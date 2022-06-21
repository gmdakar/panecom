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

/* __string_template__fbfa247c567d3a3b83ac4e30600d5d3d41d5e502f98a498b14535c76e7dc8917 */
class __TwigTemplate_8ff24760ff9063a0d35b66a767148d4e81b88b9c6a71149f768da432b6e8f3af extends \Twig\Template
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
        echo "    ";
        if ((($context["type"] ?? null) == "document")) {
            // line 2
            echo "        ";
            $context["duration"] = "3";
            // line 3
            echo "    ";
        }
        // line 4
        echo "    ";
        if ((($context["type"] ?? null) == "projet")) {
            // line 5
            echo "        ";
            $context["duration"] = "2";
            // line 6
            echo "    ";
        }
        // line 7
        echo "    ";
        if ((($context["type"] ?? null) == "organisation_membre")) {
            // line 8
            echo "        ";
            $context["duration"] = "2";
            // line 9
            echo "    ";
        }
        // line 10
        echo "
<div class=\"highlight ";
        // line 11
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["type"] ?? null), 11, $this->source), "html", null, true);
        echo "\">
<div class=\"highlight-icon\"><i class=\"fas ";
        // line 12
        if ((($context["type"] ?? null) == "document")) {
            echo " fa-trophy  ";
        }
        echo " ";
        if ((($context["type"] ?? null) == "projet")) {
            echo " fa-users  ";
        }
        echo " ";
        if ((($context["type"] ?? null) == "organisation_membre")) {
            echo " fa-file-alt  ";
        }
        echo " fa-5x\"></i></div>

<div class=\"highlight-count\"><span class=\"countup\" data-decimal=\".\" data-decimal-places=\"0\" data-duration=\"";
        // line 14
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["duration"] ?? null), 14, $this->source), "html", null, true);
        echo "\" data-end=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 14, $this->source), "html", null, true);
        echo "\" data-separator=\",\" data-start-val=\"1\" data-use-easing=\"0\" data-use-grouping=\"0\">0</span></div>

<div class=\"highlight-type \">";
        // line 16
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["type_1"] ?? null), 16, $this->source), "html", null, true);
        echo "</div>
</div>";
    }

    public function getTemplateName()
    {
        return "__string_template__fbfa247c567d3a3b83ac4e30600d5d3d41d5e502f98a498b14535c76e7dc8917";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 16,  88 => 14,  73 => 12,  69 => 11,  66 => 10,  63 => 9,  60 => 8,  57 => 7,  54 => 6,  51 => 5,  48 => 4,  45 => 3,  42 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "__string_template__fbfa247c567d3a3b83ac4e30600d5d3d41d5e502f98a498b14535c76e7dc8917", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 1, "set" => 2);
        static $filters = array("escape" => 11);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set'],
                ['escape'],
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
