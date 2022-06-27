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

/* modules/contrib/masonry_views/templates/views-view-masonry.html.twig */
class __TwigTemplate_bc1ff44f9f517f5683a72dc6cb731a37bd2d82946c7293133b94314e97fac29e extends \Twig\Template
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
        // line 22
        echo "
";
        // line 23
        if ((($context["title"] ?? null) && ($context["grouping"] ?? null))) {
            // line 24
            echo "  <h3>";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 24, $this->source), "html", null, true);
            echo "</h3>
  <div class=\"";
            // line 25
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["grouping_class"] ?? null), 25, $this->source), "html", null, true);
            echo "\">
";
        }
        // line 27
        echo "
";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 29
            echo "  ";
            // line 30
            $context["row_classes"] = [0 => ((            // line 31
($context["default_row_class"] ?? null)) ? ("views-row") : (""))];
            // line 34
            echo "  <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["row"], "attributes", [], "any", false, false, true, 34), "addClass", [0 => ($context["row_classes"] ?? null)], "method", false, false, true, 34), 34, $this->source), "html", null, true);
            echo ">
    ";
            // line 35
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["row"], "content", [], "any", false, false, true, 35), 35, $this->source), "html", null, true);
            echo "
  </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "
";
        // line 39
        if (($context["grouping"] ?? null)) {
            // line 40
            echo "  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "modules/contrib/masonry_views/templates/views-view-masonry.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 40,  83 => 39,  80 => 38,  71 => 35,  66 => 34,  64 => 31,  63 => 30,  61 => 29,  57 => 28,  54 => 27,  49 => 25,  44 => 24,  42 => 23,  39 => 22,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/masonry_views/templates/views-view-masonry.html.twig", "/home/cloudpanel/htdocs/devpanecom/modules/contrib/masonry_views/templates/views-view-masonry.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 23, "for" => 28, "set" => 30);
        static $filters = array("escape" => 24);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for', 'set'],
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
