<?php
$this->pageTitle = Yii::app()->name . ' - Notifications';
?>

<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">
            <div class="row-fluid">    
                <h3 class="contitle">Notifications</h3>
                <table class="table table-striped">
                    <tbody id="shlist">
                        <?php if ($notifs) { ?>
                            <?php foreach ($notifs as $nn) { ?>
                                <?php
                                if (!$nn->status) {
                                    $nn->status = '1';
                                    $nn->save(false);
                                }
                                ?>
                                <tr class="shan">
                                    <td>
                                        <?php
                                        $str = "";
                                        if ($nn->notif_type == 5 || $nn->notif_type == 7) {
                                            $str = "<a href='" . Yii::app()->request->baseUrl . "/home/user/" . $nn->other->username . "'>" . $nn->other->username . "</a> " . $nn->notification->type;
                                        } else if ($nn->notif_type == 3) {
                                            $str = "<a href='" . Yii::app()->request->baseUrl . "/profile/viewmessage/" . $nn->other_id . "'>" . $nn->notification->type . "</a> ";
                                        } else {
                                            $str = $nn->notification->type;
                                        }
                                        ?>
                                        <?php echo $str; ?>. <span style="color: #FD2B68;font-size: 16px;">(<?php echo $nn->notif_time; ?>)</span>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td>You have no notifications</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
                $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
                    'contentSelector' => '#shlist',
                    'itemSelector' => 'tr.shan',
                    'pages' => $pages,
                ));
                ?>
            </div>	

        </div>
    </div>
</div>