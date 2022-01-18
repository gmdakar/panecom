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

/* modules/contrib/notificationswidget/templates/notifications-widget.html.twig */
class __TwigTemplate_edacc5fdba156545ec8bdba641879e360f9157dc3fc208aa715162590021fab3 extends \Twig\Template
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
        // line 7
        echo "
<ul class=\"nav navbar-nav navbar-right\">
  <li class=\"dropdown\">
    <a href=\"#notifications-panel\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">
      ";
        // line 11
        if ((($context["unread"] ?? null) > 0)) {
            // line 12
            echo "        <i data-count=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["unread"] ?? null), 12, $this->source), "html", null, true);
            echo "\" id=\"notificationcount\" class=\"glyphicon glyphicon-bell notification-icon\"></i>
      ";
        } else {
            // line 14
            echo "        <i class=\"glyphicon glyphicon-bell notification-icon-read\"></i>
      ";
        }
        // line 16
        echo "    </a>
    <ul class=\"dropdown-menu notify-drop\">
      <div class=\"notify-drop-title fyi-notification\">
        ";
        // line 19
        if ((($context["unread"] ?? null) > 1)) {
            // line 20
            echo "          ";
            echo t("You have @unread unread notifications", array("@unread" => ($context["unread"] ?? null), ));
            // line 21
            echo "        ";
        } elseif ((($context["unread"] ?? null) > 0)) {
            // line 22
            echo "          ";
            echo t("You have @unread unread notification", array("@unread" => ($context["unread"] ?? null), ));
            // line 23
            echo "        ";
        }
        // line 24
        echo "        ";
        if ((($context["unread"] ?? null) == 0)) {
            // line 25
            echo "          ";
            echo t("You have no unread notifications", array());
            // line 26
            echo "        ";
        }
        // line 27
        echo "      </div>
      <!-- end notify title -->
      <!-- notify content -->
      <div class=\"drop-content\">
        ";
        // line 31
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["notification_list"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["notifications"]) {
            // line 32
            echo "          <li data-id=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["notifications"], "id", [], "any", false, false, true, 32), 32, $this->source), "html", null, true);
            echo "\" data-read-status = \"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(((twig_get_attribute($this->env, $this->source, $context["notifications"], "status", [], "any", false, false, true, 32)) ? ("read") : ("unread")));
            echo "\" class=\"notification-items ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(((twig_get_attribute($this->env, $this->source, $context["notifications"], "status", [], "any", false, false, true, 32)) ? ("read") : ("unread")));
            echo "\">
            <i class=\"fa fa-dot-circle-o\" aria-hidden=\"true\"></i>
            <span class=\"notification-msg\">";
            // line 34
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["notifications"], "message", [], "any", false, false, true, 34), 34, $this->source));
            echo "</span>
            <span class=\"glyphicon glyphicon-trash notification-remove\"></span>
          </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['notifications'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "      </div>
      ";
        // line 39
        if ((($context["total"] ?? null) > 0)) {
            // line 40
            echo "        <span class=\"clear-all-notification\" data-uid=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["uid"] ?? null), 40, $this->source), "html", null, true);
            echo "\" data-notification-type = \"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["notification_type"] ?? null), 40, $this->source), "html", null, true);
            echo "\">Clear All</span>
      ";
        }
        // line 42
        echo "    </ul>
  </li>
</ul>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/notificationswidget/templates/notifications-widget.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  128 => 42,  120 => 40,  118 => 39,  115 => 38,  105 => 34,  95 => 32,  91 => 31,  85 => 27,  82 => 26,  79 => 25,  76 => 24,  73 => 23,  70 => 22,  67 => 21,  64 => 20,  62 => 19,  57 => 16,  53 => 14,  47 => 12,  45 => 11,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/notificationswidget/templates/notifications-widget.html.twig", "/home/cloudpanel/htdocs/devpanecom/modules/contrib/notificationswidget/templates/notifications-widget.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 11, "trans" => 20, "for" => 31);
        static $filters = array("escape" => 12, "raw" => 34);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'trans', 'for'],
                ['escape', 'raw'],
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
