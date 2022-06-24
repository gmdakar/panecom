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

/* modules/contrib/imagefield_slideshow/templates/imagefield-slideshow.html.twig */
class __TwigTemplate_0e104b75de0f3475fad2090500a7f954e11b9cd29b0866f285957ac049d55d27 extends \Twig\Template
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
        // line 16
        $context["prev"] = twig_random($this->env);
        // line 17
        $context["next"] = twig_random($this->env);
        // line 18
        echo "<div class=\"imagefield_slideshow-wrapper\">
    <div class=\"cycle-slideshow\"
         data-cycle-pause-on-hover='";
        // line 20
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["pause"] ?? null), 20, $this->source), "html", null, true);
        echo "'
         data-cycle-fx=\"";
        // line 21
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["effect"] ?? null), 21, $this->source), "html", null, true);
        echo "\"
         data-cycle-speed=\"";
        // line 22
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["speed"] ?? null), 22, $this->source), "html", null, true);
        echo "\"
         data-cycle-timeout=\"";
        // line 23
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["timeout"] ?? null), 23, $this->source), "html", null, true);
        echo "\"
         data-cycle-prev=\"#imagefield_slideshow-prev-";
        // line 24
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["prev"] ?? null), 24, $this->source), "html", null, true);
        echo "\"
         data-cycle-next=\"#imagefield_slideshow-next-";
        // line 25
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["next"] ?? null), 25, $this->source), "html", null, true);
        echo "\"
         data-cycle-loader=\"wait\">
        ";
        // line 27
        if (($context["pager"] ?? null)) {
            // line 28
            echo "            <div class=\"cycle-pager\"></div>
        ";
        }
        // line 30
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["url"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
            // line 31
            echo "            ";
            if (($context["link_image_to"] ?? null)) {
                // line 32
                echo "                ";
                if ((twig_get_attribute($this->env, $this->source, ($context["link_image_to"] ?? null), "type", [], "any", false, false, true, 32) == "content")) {
                    // line 33
                    echo "                    <img title=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "title", [], "any", false, false, true, 33), 33, $this->source), "html", null, true);
                    echo "\" alt=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "alt", [], "any", false, false, true, 33), 33, $this->source), "html", null, true);
                    echo "\" src=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "uri", [], "any", false, false, true, 33), 33, $this->source), "html", null, true);
                    echo "\" onclick=\"window.open('";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["link_image_to"] ?? null), "path", [], "any", false, false, true, 33), 33, $this->source), "html", null, true);
                    echo "', '_self')\" />
                ";
                }
                // line 35
                echo "                ";
                if ((twig_get_attribute($this->env, $this->source, ($context["link_image_to"] ?? null), "type", [], "any", false, false, true, 35) == "file")) {
                    // line 36
                    echo "                    <img title=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "title", [], "any", false, false, true, 36), 36, $this->source), "html", null, true);
                    echo "\" alt=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "alt", [], "any", false, false, true, 36), 36, $this->source), "html", null, true);
                    echo "\" src=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "uri", [], "any", false, false, true, 36), 36, $this->source), "html", null, true);
                    echo "\" onclick=\"window.open('";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "uri", [], "any", false, false, true, 36), 36, $this->source), "html", null, true);
                    echo "', '_self')\" />
                ";
                }
                // line 38
                echo "            ";
            } else {
                // line 39
                echo "                <img title=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "title", [], "any", false, false, true, 39), 39, $this->source), "html", null, true);
                echo "\" alt=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "alt", [], "any", false, false, true, 39), 39, $this->source), "html", null, true);
                echo "\" src=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["value"], "uri", [], "any", false, false, true, 39), 39, $this->source), "html", null, true);
                echo "\" />
            ";
            }
            // line 41
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "    </div>
    ";
        // line 43
        if (($context["prev_next"] ?? null)) {
            // line 44
            echo "        <div class=\"prev-next\">
            <a href=# id=\"imagefield_slideshow-prev-";
            // line 45
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["prev"] ?? null), 45, $this->source), "html", null, true);
            echo "\">Prev</a>
            <a href=# id=\"imagefield_slideshow-next-";
            // line 46
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["next"] ?? null), 46, $this->source), "html", null, true);
            echo "\">Next</a>
        </div>
    ";
        }
        // line 49
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/imagefield_slideshow/templates/imagefield-slideshow.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 49,  147 => 46,  143 => 45,  140 => 44,  138 => 43,  135 => 42,  129 => 41,  119 => 39,  116 => 38,  104 => 36,  101 => 35,  89 => 33,  86 => 32,  83 => 31,  78 => 30,  74 => 28,  72 => 27,  67 => 25,  63 => 24,  59 => 23,  55 => 22,  51 => 21,  47 => 20,  43 => 18,  41 => 17,  39 => 16,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Default theme implementation to display a formatted imagefield slideshow field.
 *
 * Available variables:
 * - image: A collection of image data.
 * - image_style: An optional image style.
 * - url: An optional URL the image can be linked to.
 *
 * @see template_preprocess_image_formatter()
 *
 * @ingroup themeable
 */
#}
{% set prev = random() %}
{% set next = random() %}
<div class=\"imagefield_slideshow-wrapper\">
    <div class=\"cycle-slideshow\"
         data-cycle-pause-on-hover='{{ pause }}'
         data-cycle-fx=\"{{ effect }}\"
         data-cycle-speed=\"{{ speed }}\"
         data-cycle-timeout=\"{{ timeout }}\"
         data-cycle-prev=\"#imagefield_slideshow-prev-{{ prev }}\"
         data-cycle-next=\"#imagefield_slideshow-next-{{ next }}\"
         data-cycle-loader=\"wait\">
        {% if pager %}
            <div class=\"cycle-pager\"></div>
        {% endif %}
        {% for key,value in url %}
            {% if link_image_to %}
                {% if link_image_to.type == 'content' %}
                    <img title=\"{{ value.title }}\" alt=\"{{ value.alt }}\" src=\"{{ value.uri }}\" onclick=\"window.open('{{ link_image_to.path }}', '_self')\" />
                {% endif %}
                {% if link_image_to.type == 'file' %}
                    <img title=\"{{ value.title }}\" alt=\"{{ value.alt }}\" src=\"{{ value.uri }}\" onclick=\"window.open('{{ value.uri }}', '_self')\" />
                {% endif %}
            {% else %}
                <img title=\"{{ value.title }}\" alt=\"{{ value.alt }}\" src=\"{{ value.uri }}\" />
            {% endif %}
        {% endfor %}
    </div>
    {% if prev_next %}
        <div class=\"prev-next\">
            <a href=# id=\"imagefield_slideshow-prev-{{ prev }}\">Prev</a>
            <a href=# id=\"imagefield_slideshow-next-{{ next }}\">Next</a>
        </div>
    {% endif %}
</div>
", "modules/contrib/imagefield_slideshow/templates/imagefield-slideshow.html.twig", "/home/cloudpanel/htdocs/devpanecom/modules/contrib/imagefield_slideshow/templates/imagefield-slideshow.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 16, "if" => 27, "for" => 30);
        static $filters = array("escape" => 20);
        static $functions = array("random" => 16);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'for'],
                ['escape'],
                ['random']
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
