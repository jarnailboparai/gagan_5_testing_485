<?php
foreach($account->lists as $offset => $list) {
?>
<h1>List: <?php echo $list->name; ?></h1>
<h3><?php echo $list->id; ?></h3>
<table>
  <tr>
    <th class="stat">Subject</th>
    <th class="value">Sent</th>
    <th class="value">Stats</th>
  </tr>
<?php
foreach($list->campaigns as $campaign) {
    if ($campaign->type == 'broadcast_campaign') {
?>
    <tr>
        <td class="stat"><em><?php echo $campaign->subject; ?></em></td>
        <td class="value"><?php echo date('F j, Y h:iA', strtotime($campaign->sent_at)); ?></td>
        <td class="value"><ul>
              <li><b>Opened:</b> <?php echo $campaign->total_opens; ?></li>
              <li><b>Sent:</b>  <?php echo $campaign->total_sent; ?></li>
              <li><b>Clicked:</b>  <?php echo $campaign->total_clicks; ?></li>
            </ul>
        </td>
    <?php
    }
} ?>
</table>
<?php }
?>
