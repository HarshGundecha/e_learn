<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
  ajaxUrl, ajaxDataContainer=false, ajaxOPType=false, ajaxOPID=false, toggleModal=false, isImageUpload=false


  if ajaxDataContainer==false then
    isImageUpload=false

  OpType = 1-dt, 2-container(html), 3-no OP 
  OpId = respective opType ID


  success = reload dt, close modal, show success alert at a place based on actionType 
  fail = neither reload dt nor close modal, show fail alert at a place based on actionType


  // final arguements
  ajaxUrl, ajaxDataContainer=false, ajaxOPType=false, ajaxOPID=false, actionType
  actionType=1=add, 2=update , 3=b/ub, 4=other


  var ajaxDataContainer="#trial";
  var aa=$(ajaxDataContainer+' input[type="file"]').length; //sets aa to 1 if input file exists else 0
*/
class JsDatatableCode
{
  private $__DT_BUTTON_HANDLER='';
  private $__ENTITY='';
  private $__CI;
  private $__ADMIN_CNT='';
  public function __construct($params)
  {
    $this->__ENTITY=$params[0];
    $this->__CI =& get_instance();
    $this->__CI->load->helper('url');
    $this->__ADMIN_CNT=$this->__CI->config->item('admin_site_folder').$this->__ENTITY;
  }

  function getDatatable($datatableIdentifier, $datatableUrl, $columnNames, $otherColumnData=false)
  {
    $retData='';
    $retData.='
    // JQ Datatable Code
    $(function(){
      var t=$(\''.$datatableIdentifier.'\').DataTable({
        dom: \'<"col-md-3"l><"col-md-5"B><"col-md-4"f>rt<"col-md-4"i><"col-md-8"p>\',
        //dom: \'<"col-md-2"l><"col-md-3 col-md-offset-1"f><"col-md-5 pull-right"B>rt<"col-md-4"i><"col-md-8"p>\',
        //dom: \'<"col-md-6"l><"col-md-6"f><"col-md-12"B>rt<"col-md-4"i><"col-md-8"p>\',
        /*
        l-length
        b-button
        f-filter
        i-info
        p-paging
        t-table
        */
        buttons: [
          {
            extend: "copyHtml5",
            text: "<i class=\'fa fa-copy\' title=\'Copy\' data-toggle=\'tooltip\' style=\'font-size:1.5em;color:#ef5350;\'></i>",
            exportOptions: {
                columns: ":visible:not(.not-export-col)",
                stripHtml: false
            }
          },
          {
            extend: "pdfHtml5",
            text: "<i class=\'fa fa-file-pdf-o\' title=\'Download PDF\' data-toggle=\'tooltip\' style=\'font-size:1.5em;color:#4caf50;\'></i>",
            exportOptions: {
                columns: ":visible:not(.not-export-col)",
                stripHtml: true
            }
          },
          {
            extend: "print",
            text: "<i class=\'fa fa-print\' title=\'Print\' data-toggle=\'tooltip\' style=\'font-size:1.5em;color:#9575cd;\'></i>",
            exportOptions: {
                columns: ":visible:not(.not-export-col)",
                stripHtml: false
            }
          },
          {
            extend: "excelHtml5",
            text: "<i class=\'fa fa-file-excel-o\' title=\'Download Excel\' data-toggle=\'tooltip\' style=\'font-size:1.5em;color:#ffa726;\'></i>",
            exportOptions: {
                columns: ":visible:not(.not-export-col)",
                stripHtml: false
            }
          },
          {
            extend: "csvHtml5",
            text: "<i class=\'fa fa-file-text-o\' title=\'Download CSV\' data-toggle=\'tooltip\' style=\'font-size:1.5em;color:#4db6ac\'></i>",
            exportOptions: {
                columns: ":visible:not(.not-export-col)",
                stripHtml: false
            }
          },
          {
            extend: "colvis",
            text: "<i class=\'fa fa-eye\' title=\'Column Visibility\' data-toggle=\'tooltip\' style=\'font-size:1.5em;color:#a1887f;\'></i>",
            exportOptions: {
                columns: ":visible:not(.not-export-col)",
                stripHtml: false
            }
          },
        ],
        // buttons: [
        //     "copyHtml5",
        //     "pdfHtml5",
        //     "print",
        //     "excelHtml5",
        //     "csvHtml5",
        //     "colvis"
        // ],
        colReorder: true,
      columnDefs: [{
        searchable  : true,
        orderable   : true,
        targets     : 0,
        className   : "text-center", 
        targets     : "_all",
      }],
      paging        : true,
      responsive  : true,
      lengthChange  : true,
      searching     : true,
      ordering      : true,
      info          : true,
      scrollY       : \'52vh\',
      scrollX       : true,
      scrollCollapse: true,
      autoWidth     : false,
      bProcessing   : true,
      sAjaxSource   : "'.site_url($datatableUrl).'",
      aoColumns     : [';
        //{ data  : null},'."\n\t\t\t";
    $i=0;

    foreach ($columnNames as $CN)
      if($CN)
        $retData.= "{ mData : '$CN'},\n\t\t\t";
      else
      {
        $retData.= "{ data  : null,\n\t\t\t\t\t  render: function ( data, type, row )
          { ".'$finalData=\'\';'.$otherColumnData[$i].'return $finalData;'."}},";
        $i++;
      }

    $retData.='         ],
              order: [[ 0, \'asc\' ]]
            });

            /*t.on( \'order.dt search.dt\', function () {
            t.column(0, {search:\'applied\', order:\'applied\'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
          } );
        } ).draw();*/

        //alert("hello");
      '.$this->__DT_BUTTON_HANDLER.'
      });
      // JQ Datatable Code
      ';

    return $retData;
  }

  function dtImage($imagePath, $imageName)
  {
    return '
    $finalData+=\'<img style="max-height:75px;max-width:75px;display: block;margin: 0 auto;" alt="Image Not Found" src="'.base_url().$imagePath.'\'+data.'.$imageName.'+\''.'">\';
    ';
  }

  function dtToggleStatusButton($primaryKeyColumn, $status)
  {
    $this->__DT_BUTTON_HANDLER.=$this->dtToggleStatusButtonJSCode();
    return '
      var btn_class=data.'.$status.'=="Active"?"fa fa-toggle-on":"fa fa-toggle-off";
      var btn_tooltip=data.'.$status.'=="Active"?"Block\nRecord":"UnBlock\nRecord";

      $finalData +=\'&nbsp;&nbsp;<a><span class="\'+btn_class+\'" id="\'+data.'.$primaryKeyColumn.'+\'/\'+data.'.$status.'+\'" title="\'+btn_tooltip+\'" style="font-size:2.5em;cursor:pointer" data-toggle="tooltip"></span></a><i style="color:#009688;font-size:1.7em;display: none;" class="fa fa-circle-o-notch fa-spin"></i>\';
    ';
  }

  function dtMoreInfoAjaxButton($primaryKeyColumn)
  {
    $this->__DT_BUTTON_HANDLER.=$this->dtMoreInfoAjaxButtonJSCode();
    return '
      $finalData+=\'&nbsp;&nbsp;<a><span class="fa fa-info-circle" id="\'+data.'.$primaryKeyColumn.'+\'" title="More\nInformation" style="font-size:2.5em;cursor:pointer" data-toggle="tooltip"></span></a>\';
    ';
  }

  function dtMoreInfoLinkButton($link,$id=false)
  {
    return '
      $finalData+=\'&nbsp;&nbsp;<a href="'.$link.'\'+data.'.$id.'+\'"><span class="fa fa-info-circle" title="More\nInformation" style="font-size:2.5em;cursor:pointer" data-toggle="tooltip"></span></a>\';
    ';
  }

  function dtLink($link,$text,$id=false)
  {
    return '
      $finalData+=\'&nbsp;&nbsp;<a href="'.$link.'\'+data.'.$id.'+\'" title="Click for more info." data-toggle="tooltip">'.$text.'</a>\';
    ';
  }

  // dynamic link text between <a> </a>
  function dtLink2($link,$text,$id=false)
  {
    return '
      $finalData+=\'&nbsp;&nbsp;<a href="'.$link.'\'+data.'.$id.'+\'" title="Click for more info." data-toggle="tooltip">\'+data.'.$text.'+\'</a>\';
    ';
  }
  
  function dtUpdateButton($primaryKeyColumn)
  {
    $this->__DT_BUTTON_HANDLER.=$this->dtUpdateButtonJSCode();
    return '
      $finalData+=\'&nbsp;&nbsp;<a><span class="fa fa-edit" id="\'+data.'.$primaryKeyColumn.'+\'" title="Update\nInformation" style="font-size:2.5em;cursor:pointer" data-toggle="tooltip"></span></a>\';
    ';
  }

  function dtOtherElement($htmlCode)
  {
    return '$finalData+= \''.$htmlCode.'\';';
  }

  function dtData($queryResult)
  {
    return json_encode([
      "sEcho" => 1,
      "iTotalRecords" => count($queryResult),
      "iTotalDisplayRecords" => count($queryResult),
      "aaData"=>$queryResult
    ]);
  }

  private function dtMoreInfoAjaxButtonJSCode()
  {
    return '
      $("#tblView'.$this->__ENTITY.'").on("click","tbody .fa-info-circle, tbody .fa-info",function(){
        AIOAjax
        (
          "'.$this->__ADMIN_CNT.'/getInfoEntityContent/"+$(this).attr("id"),
          4,
          false,
          2,
          "#contentInfoModal"
        );
      });
    ';
  }

  private function dtUpdateButtonJSCode()
  {
    return '
      $("#tblView'.$this->__ENTITY.'").on("click","tbody .fa-edit",function(){
        AIOAjax
        (
          "'.$this->__ADMIN_CNT.'/getUpdateEntityContent/"+$(this).attr("id"),
          2,
          false,
          2,
          "#formUpdate'.$this->__ENTITY.'"
        );
      });
    ';
  }

/*  private function dtToggleStatusButtonJSCode()
  {
    return '
      $("#tblView'.$this->__ENTITY.'").on("click","tbody .fa-toggle-on, tbody .fa-toggle-off",function(){
        AIOAjax
        (
          "'.$this->__ADMIN_CNT.'/toggleEntityStatus/"+$(this).attr("id"),
          5,
          false,
          1,
          "#tblView'.$this->__ENTITY.'"
        );
      });
    ';
  } */
  private function dtToggleStatusButtonJSCode()
  {
    return '
      $("#tblView'.$this->__ENTITY.'").on("click","tbody .fa-toggle-on, tbody .fa-toggle-off",function(){
        var aa=$(this);
        $.ajax({
          url:\''.$this->__ENTITY.'/toggleEntityStatus/\'+$(this).attr("id"),
          beforeSend:function(jqXHR, settings){
            aa.parent().hide();
            aa.parent().next().show();
          },
          complete:function(xhr,status){
            aa.parent().next().hide();
          },
          success:function(result){
            $("#tblView'.$this->__ENTITY.'").DataTable().ajax.reload(null,false);
              var Jresult = JSON.parse(result);
              if(Jresult.status==true)
              {
                $(\'#pageAlert\')
                  .html(Jresult.message)
                    .parent()
                      .css(\'display\',\'block\');
              }
          }
        });
      });
    ';
  }
}
?>