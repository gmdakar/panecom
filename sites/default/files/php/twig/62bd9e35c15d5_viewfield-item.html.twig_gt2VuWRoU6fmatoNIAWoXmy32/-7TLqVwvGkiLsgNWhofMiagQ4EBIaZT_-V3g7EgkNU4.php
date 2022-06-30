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

/* modules/contrib/viewfield/templates/viewfield-item.html.twig */
class __TwigTemplate_e67f7e0615772b6ee2e6d104535fc0746434cf181704016edb2382ea7eb55a6e extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 42
        $context["classes"] = [0 => "field__item", 1 => ("field__item-label-" . $this->sandbox->ensureToStringAllowed(        // line 44
($context["label_display"] ?? null), 44, $this->source))];
        // line 48
        $context["title_classes"] = [0 => "field__item__label", 1 => (((        // line 50
($context["label_display"] ?? null) == "visually_hidden")) ? ("visually-hidden") : (""))];
        // line 53
        echo "
<div";
        // line 54
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 54), 54, $this->source), "html", null, true);
        echo ">
  ";
        // line 55
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null), 55, $this->source), "html", null, true);
        echo "
  ";
        // line 56
        if (( !($context["label_hidden"] ?? null) && ($context["label"] ?? null))) {
            // line 57
            echo "    <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["title_attributes"] ?? null), "addClass", [0 => ($context["title_classes"] ?? null)], "method", false, false, true, 57), 57, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 57, $this->source), "html", null, true);
            echo "</div>
  ";
        }
        // line 59
        echo "  ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null), 59, $this->source), "html", null, true);
        echo "
  ";
        // line 60
        $this->displayBlock('content', $context, $blocks);
        // line 63
        echo "</div>
";
    }

    // line 60
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 61
        echo "    ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 61, $this->source), "html", null, true);
        echo "
  ";
    }

    public function getTemplateName()
    {
        return "modules/contrib/viewfield/templates/viewfield-item.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 61,  79 => 60,  74 => 63,  72 => 60,  67 => 59,  59 => 57,  57 => 56,  53 => 55,  49 => 54,  46 => 53,  44 => 50,  43 => 48,  41 => 44,  40 => 42,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/viewfield/templates/viewfield-item.html.twig", "/home/cloudpanel/htdocs/devpanecom/modules/contrib/viewfield/templates/viewfield-item.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 42, "if" => 56, "block" => 60);
        static $filters = array("escape" => 54);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'block'],
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
