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

/* modules/contrib/photoswipe/templates/photoswipe-container.html.twig */
class __TwigTemplate_7a3b6fb2891c680a7e692946d8e3ed959b34f6811cec30ae69b02ad200501eaa extends \Twig\Template
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
        // line 2
        echo "<div class=\"pswp\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">

  ";
        // line 8
        echo "  <div class=\"pswp__bg\"></div>

  ";
        // line 11
        echo "  <div class=\"pswp__scroll-wrap\">

    ";
        // line 18
        echo "
    <div class=\"pswp__container\">
      <div class=\"pswp__item\"></div>
      <div class=\"pswp__item\"></div>
      <div class=\"pswp__item\"></div>
    </div>

    ";
        // line 29
        echo "    <div class=\"pswp__ui pswp__ui--hidden\">

      <div class=\"pswp__top-bar\">

        ";
        // line 34
        echo "
        <div class=\"pswp__counter\"></div>

        <button class=\"pswp__button pswp__button--close\" title=\"";
        // line 37
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Close (Esc)"));
        echo "\"></button>

        <button class=\"pswp__button pswp__button--share\" title=\"";
        // line 39
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Share"));
        echo "\"></button>

        <button class=\"pswp__button pswp__button--fs\" title=\"";
        // line 41
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Toggle fullscreen"));
        echo "\"></button>

        <button class=\"pswp__button pswp__button--zoom\" title=\"";
        // line 43
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Zoom in/out"));
        echo "\"></button>

        ";
        // line 50
        echo "
        <div class=\"pswp__preloader\">
          <div class=\"pswp__preloader__icn\">
            <div class=\"pswp__preloader__cut\">
              <div class=\"pswp__preloader__donut\"></div>
            </div>
          </div>
        </div>
      </div>

      <div class=\"pswp__share-modal pswp__share-modal--hidden pswp__single-tap\">
        <div class=\"pswp__share-tooltip\"></div>
      </div>

      <button class=\"pswp__button pswp__button--arrow--left\" title=\"";
        // line 64
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Previous (arrow left)"));
        echo "\">
      </button>

      <button class=\"pswp__button pswp__button--arrow--right\" title=\"";
        // line 67
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Next (arrow right)"));
        echo "\">
      </button>

      <div class=\"pswp__caption\">
        <div class=\"pswp__caption__center\"></div>
      </div>

    </div>

  </div>

</div>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/photoswipe/templates/photoswipe-container.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 67,  107 => 64,  91 => 50,  86 => 43,  81 => 41,  76 => 39,  71 => 37,  66 => 34,  60 => 29,  51 => 18,  47 => 11,  43 => 8,  39 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/photoswipe/templates/photoswipe-container.html.twig", "/home/cloudpanel/htdocs/devpanecom/modules/contrib/photoswipe/templates/photoswipe-container.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("t" => 37);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                ['t'],
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
