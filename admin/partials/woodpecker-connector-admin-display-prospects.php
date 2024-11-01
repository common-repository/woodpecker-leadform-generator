<?php
/**
 * Admin backend for Prospects
 *
 * @link       #
 * @since      2.0.0
 * @author     Woodpecker Team
 * @package    Woodpecker_Connector
 * @subpackage Woodpecker_Connector/admin/partials
 */

if (!defined('Woodpecker_Connector_Admin')) :
    die('Direct access not permitted');
endif;

$url = '?page=woodpecker-connector&tab=prospects';

$statusUrlList = array();
$perPage = 10;
$page = 1;


if (isset($_GET['status'])) :
  $statusUrlList = explode(",", strip_tags($_GET['status']));
  $statusUrlList = array_unique($statusUrlList);
endif;

if (isset($_GET['per_page']) && $_GET['per_page'] != 0  && ($_GET['per_page'] == 10 || $_GET['per_page'] == 25
      || $_GET['per_page'] == 50 || $_GET['per_page'] == 100 || $_GET['per_page'] == 250 || $_GET['per_page'] == 500)) :
  $perPage = strip_tags($_GET['per_page']);
endif;

if (isset($_GET['pageApi'])) :
  $page = strip_tags($_GET['pageApi']);
endif;

$urlBuilder = new Woodpecker_URL_Builder($url, $statusUrlList, $perPage, $page);
$getconnectprospects = new Woodpecker_Connector_Curl('/rest/v1/prospects?campaigns_details=true&search=tags=wordpress&per_page=' . $perPage . '&page=' . $page . $urlBuilder->getCurlUrl(),
$options['api_key']);
$getjsonprospects = $getconnectprospects->getJson();
$getstatus = $getjsonprospects->status;

$fullList = array();

if ($getstatus->status != 'ERROR' && $options['api_key'] != '') :
  $popupId = 0;

  foreach ((array)$getjsonprospects as $prosp) :
    $status = strip_tags($prosp->status);
    $firstName = strip_tags($prosp->first_name);
    $lastName = strip_tags($prosp->last_name);
    $email = strip_tags($prosp->email);
    $company = strip_tags($prosp->company);
    $howCampaign = count($prosp->campaigns_details);

    $tooltip = '
    <div id="popupTooltipCampaign' . $popupId . '" class="popupTooltip">
      <div class="popupTooltip__arrow">
        <div class="arrow-l"></div>
        <div class="arrow-r"></div>
      </div>
      <div class="popupTooltip__content">';

    if ($howCampaign > 0) :
      foreach ((array)$prosp->campaigns_details as $campaignName) :
        $tooltip .= '<div class="popupTooltip__content--item-disabled"><div class="popupTooltip__content--item__text">' . $campaignName->campaign_name . '</div></div>';
      endforeach;
    endif;

    $tooltip .= '
      </div>
    </div>';

    $view = '<div class="prospect-content__table--row">
                <div class="row-table">' . (empty($status) ? '—' : $status) . '</div>
                <div class="row-table fontDemi">' . (empty($firstName) && empty($lastName) ? '—' : $firstName . " " . $lastName)  . '</div>
                <div class="row-table">' . (empty($email) ? '—' : $email) . '</div>
                <div class="row-table">' . (empty($company) ? '—' : $company) . '</div>';
    if ($howCampaign == 0) :
      $view .= '  <div class="row-table center"><span class="how-campaign">' . $howCampaign . '</span></div>';
    else :
      $view .= '  <div class="row-table center"><span class="how-campaign textLink" onclick="openPopupTooltip(\''.$popupId.'\', this)">' . $howCampaign . '</span></div>
                  ' . $tooltip;
    endif;
    $view .= '</div>';

    $popupId++;
    array_push($fullList, array($view, $status, $firstName, $lastName, $email, $company, $prosp->campaigns_details));
  endforeach;
?>
  <div class="col-container">
    <div class="col-container__margin">
      <div class="prospect-content">
        <h5 class="uppercase"><?php _e('Prospects from woodpecker for WordPress', $this->plugin_name); ?></h5>
        <?php if (count($view) > 0 || (count($view) == 0 && !empty($urlBuilder->getCurlUrl()))) : ?>
          <section class="filter-panel">
            <input type="text" id="searchBox" value="" placeholder="search..." style="display: none;">
            <span style="display: none;"><?php _e('or', $this->plugin_name); ?></span>
            <span style="margin-left: 0;"><?php _e('filter by:', $this->plugin_name); ?></span>
            <span class="linkLabel" onclick="openPopupTooltip('status', this)"><?php _e('status', $this->plugin_name); ?></span>
            <div id="popupTooltipStatus" class="popupTooltip">
              <div class="popupTooltip__arrow">
                <div class="arrow-l"></div>
                <div class="arrow-r"></div>
              </div>
              <div class="popupTooltip__content">
                <a href="<?php _e($urlBuilder->getUrlWith('status', 'ACTIVE')); ?>" class="popupTooltip__content--item">
                  <div class="popupTooltip__content--item__text">
                    <?php _e('ACTIVE', $this->plugin_name); ?>
                  </div>
                </a>
                <a href="<?php _e($urlBuilder->getUrlWith('status', 'BOUNCED')); ?>" class="popupTooltip__content--item">
                  <div class="popupTooltip__content--item__text">
                    <?php _e('BOUNCED', $this->plugin_name); ?>
                  </div>
                </a>
                <a href="<?php _e($urlBuilder->getUrlWith('status', 'REPLIED')); ?>" class="popupTooltip__content--item">
                  <div class="popupTooltip__content--item__text">
                    <?php _e('REPLIED', $this->plugin_name); ?>
                  </div>
                </a>
                <a href="<?php _e($urlBuilder->getUrlWith('status', 'BLACKLIST')); ?>" class="popupTooltip__content--item">
                  <div class="popupTooltip__content--item__text">
                    <?php _e('BLACKLIST', $this->plugin_name); ?>
                  </div>
                </a>
                <a href="<?php _e($urlBuilder->getUrlWith('status', 'INVALID')); ?>" class="popupTooltip__content--item">
                  <div class="popupTooltip__content--item__text">
                    <?php _e('INVALID', $this->plugin_name); ?>
                  </div>
                </a>
              </div>
            </div>
          </section>

          <section class="tags-panel">
            <?php _e($urlBuilder->getFilters()); ?>
          </section>

          <section class="empty-filter-panel">
            <div class="empty-filter-panel__img"></div>
            <div class="empty-filter-panel__empty">
              <?php _e("Can't find what you're looking for", $this->plugin_name); ?><br>
              <a href="<?php _e($url); ?>"><div class="empty-filter-panel__btn"><?php _e("Clear all filters", $this->plugin_name); ?></div></a>
            </div>
          </section>

          <section class="prospect-content__table">
            <div class="prospect-content__table--row title fontDemi">
              <div><?php _e('Status', $this->plugin_name); ?></div>
              <div><?php _e('Name', $this->plugin_name); ?></div>
              <div><?php _e('Email', $this->plugin_name); ?></div>
              <div><?php _e('Company', $this->plugin_name); ?></div>
              <div><?php _e('Imported to', $this->plugin_name); ?></div>
            </div>
            <div class="prospect-content__table--row__content">
              <?php
                for ($i = 0; $i < $perPage; $i++) :
                  _e($fullList[$i][0]);
                endfor;
                $current_url = "//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
              ?>
            </div>
          </section>
          <section class="pagination-section">
            Show rows:
            <div class="pagination-section__dropdown">
              <span class="pagination-section__rows" onclick="openDropdown(this)"><?php _e($perPage); ?></span>
              <div class="pagination-section__rows--block" style="display: none;">
                <a href="<?php _e($url) . '&per_page=10'; ?>">10</a>
                <a href="<?php _e($url) . '&per_page=14'; ?>">25</a>
                <a href="<?php _e($url) . '&per_page=50'; ?>">50</a>
                <a href="<?php _e($url) . '&per_page=100'; ?>">100</a>
                <a href="<?php _e($url) . '&per_page=250'; ?>">250</a>
                <a href="<?php _e($url) . '&per_page=500'; ?>">500</a>
              </div>
            </div>
            Go to page: <input type="text" id="page" onkeydown="return ( event.ctrlKey || event.altKey
                      || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                      || (95<event.keyCode && event.keyCode<106)
                      || (event.keyCode==8) || (event.keyCode==9)
                      || (event.keyCode>34 && event.keyCode<40)
                      || (event.keyCode==46) )" value="<?php _e($page); ?>"/>
            <div class="pagination-section__max-pages">
            out of
            <?php
              $maxPage = ceil($getconnectprospects->getTotalCount() / $perPage);
              _e($maxPage);
            ?>
            </div>
            <div class="pagination-section__direct">
              <?php
                $prev = $page - 1;
                $next = $page + 1;

                if ($prev < 1) :
                  _e('<span class="first disabled">First</span>
                      <span class="page-sep"></span>
                      <span class="prev disabled"></span>');
                else :
                  _e('<a href="' . $current_url . '&pageApi=1" class="first">First</a>
                      <span class="page-sep"></span>
                      <a href="' . $current_url . '&pageApi=' . $prev . '" class="prev"></a> ');
                endif;

                $how = (int)($page * $perPage) - ($perPage - 1);
                $count = $page * $perPage;

                if ($page >= $maxPage && $getconnectprospects->getTotalCount() < $count) :
                  $count = $getconnectprospects->getTotalCount();
                endif;

                _e('<div class="pagination-section__direct--current-pages">' . $how . '-' . $count . ' of ' . $getconnectprospects->getTotalCount() . '</div>');

                if($page >= $maxPage) :
                  _e('<span class="next disabled"></span>
                      <span class="page-sep"></span>
                      <span class="last disabled">Last</span>');
                else :
                  _e('<a href="' . $current_url . '&pageApi=' . $next . '" class="next"></a>
                      <span class="page-sep"></span>
                      <a href="' . $current_url . '&pageApi=' . $maxPage . '" class="last">Last</a>');
                endif;
              ?>
              <input value="<?php _e($maxPage); ?>" id="lastPage" type="hidden">
              <input value="<?php _e($current_url) . '&pageApi='; ?>" id="redirectUrl" type="hidden">
            </div>
          </section>
          <script type="text/javascript">
            <?php
              if(count($view) <= 0) :
                _e("jQuery('.empty-filter-panel').addClass('show');
                    jQuery('.pagination-section').hide();
                    jQuery('.prospect-content__table').hide();");
              else:
                _e("jQuery('.empty-filter-panel').removeClass('show');
                    jQuery('.pagination-section').show();
                    jQuery('.prospect-content__table').show();");
              endif;
            ?>
          </script>
          <script type="text/javascript" src="<?php _e(plugin_dir_url( __FILE__ )); ?>../js/woodpecker-connector-prospects-min.js?ver=2.1"></script>
        <?php else: ?>
          <section class="no-elements">
            <div class="no-elements__text">
              You have no prospects yet!<br>
              <span class="no-elements__text--small">It seems that you have no prospects collected via Woodpecker for Wordpress plugin yet.</span><br>
            </div>
          </section>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php
endif;
?>
