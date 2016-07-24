<!-- details_comments_block.tpl - Display Work Order Comments (Work Orders - Details Page) -->
<table class="olotable" width="100%" border="0"  cellpadding="0" cellspacing="0" summary="Work order display">
    <tr>
        <td class="olohead">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td class="menuhead2" width="80%">&nbsp;{$translate_workorder_details_comments_title}</td>
                    <td class="menuhead2" width="20%" align="right">
                        <table cellpadding="2" cellspacing="2" border="0">
                            <tr>
                                <td width="33%" align="right">
                                    <a href="?page=workorder:details_edit_comments&wo_id={$single_workorder_array[i].WORK_ORDER_ID}&page_title={$translate_workorder_details_edit_comments_title}">
                                        <img src="{$theme_images_dir}icons/16x16/small_edit.gif" border="0"
                                             onMouseOver="ddrivetip('{$translate_workorder_details_edit_comments_button_tooltip}');"
                                             onMouseOut="hideddrivetip();">
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    {if $hide_work_order_comment == 1}
    {else}
        <td class="menutd">
            <table width="100%" cellpadding="4" cellspacing="0">
                <tr>
                    <td>{$single_workorder_array[i].WORK_ORDER_COMMENT}<br></td>
                </tr>
            </table>    
        </td>
    {/if}
    </tr>
</table>