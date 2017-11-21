<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reminder</title>
    <style type="text/css">
      #outlook a { padding:0; }
      body{
        width:100% !important;
        margin:0;
        padding:0;
        -webkit-text-size-adjust:100%;
        -ms-text-size-adjust:100%;
      }
      .ExternalClass {
        width:100%;
      }
      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass font,
      .ExternalClass td,
      .ExternalClass div {
        line-height: 100%;
      }
      #backgroundTable {
        margin:0;
        padding:0;
        width:100% !important;
        line-height: 100% !important;
      }
      img {
        outline:none;
        text-decoration:none;
        border:none;
        -ms-interpolation-mode: bicubic;
      }
      a img {border:none;}
      .image_fix {display:block;}
      p {margin: 0px 0px !important;}
      table {
        border-collapse:collapse;
        mso-table-lspace:0pt;
        mso-table-rspace:0pt;
      }
      table td {border-collapse: collapse;}
      table[class=full] {
        width: 100%;
        clear: both;
      }
     /*################################################*/
     /*IPAD STYLES*/
     /*################################################*/
     @media only screen and (max-width: 640px) {
     a[href^="tel"], a[href^="sms"] {
     text-decoration: none;
     color: #ffffff; /* or whatever your want */
     pointer-events: none;
     cursor: default;
     }
     .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
     text-decoration: default;
     color: #ffffff !important;
     pointer-events: auto;
     cursor: default;
     }
     table[class=devicewidth] {width: 440px!important;text-align:center!important;}
     table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
     table[class="sthide"]{display: none!important;}
     img[class="bigimage"]{width: 420px!important;height:219px!important;}
     img[class="col2img"]{width: 420px!important;height:258px!important;}
     img[class="image-banner"]{width: 440px!important;height:106px!important;}
     td[class="menu"]{text-align:center !important; padding: 0 0 10px 0 !important;}
     td[class="logo"]{padding:10px 0 5px 0!important;margin: 0 auto !important;}
     img[class="logo"]{padding:0!important;margin: 0 auto !important;}

     }
     /*##############################################*/
     /*IPHONE STYLES*/
     /*##############################################*/
     @media only screen and (max-width: 480px) {
     a[href^="tel"], a[href^="sms"] {
     text-decoration: none;
     color: #ffffff; /* or whatever your want */
     pointer-events: none;
     cursor: default;
     }
     .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
     text-decoration: default;
     color: #ffffff !important;
     pointer-events: auto;
     cursor: default;
     }
     table[class=devicewidth] {width: 280px!important;text-align:center!important;}
     table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
     table[class="sthide"]{display: none!important;}
     img[class="bigimage"]{width: 260px!important;height:136px!important;}
     img[class="col2img"]{width: 260px!important;height:160px!important;}
     img[class="image-banner"]{width: 280px!important;height:68px!important;}

    }
  </style>
</head>
<body>
  <div class="block">
    <table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader">
      <tbody>
        <tr>
          <td width="100%">
            <table width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
              <tbody>
                <tr>
                  <td width="100%" height="5"></td>
                </tr>
                <tr>
                  <td align="right" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #999999" st-content="preheader">
                    If you cannot read this email, please  <a class="hlite" href="#" style="text-decoration: none; color: #0db9ea">click here</a>
                  </td>
                </tr>
                <tr>
                  <td width="100%" height="5"></td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="block">
    <table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="header">
      <tbody>
        <tr>
          <td>
            <table width="580" bgcolor="#0db9ea" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" hlitebg="edit" shadow="edit">
              <tbody>
                <tr>
                  <td>
                    <table width="280" cellpadding="0" cellspacing="0" border="0" align="left" class="devicewidth">
                      <tbody>
                        <tr>
                          <td valign="middle" width="270" style="padding: 10px 0 10px 20px;" class="logo">
                            <div class="imgpop">
                              <a href="#" style="text-decoration:none;color: white;font-family: Helvetica, arial, sans-serif; font-size: 18px; text-align:left;line-height: 20px;">
                                <strong>{{ $event->title }} Event Update</strong>
                              </a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="block">
    <table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="bigimage">
      <tbody>
        <tr>
          <td>
            <table bgcolor="#ffffff" width="580" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" modulebg="edit">
              <tbody>
                <tr>
                  <td width="100%" height="20"></td>
                </tr>
                <tr>
                  <td>
                    <table width="540" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner">
                      <tbody>
                        <tr>
                          <td align="center">
                            <a target="_blank" href="#">
                              <img src="{{ $message->embed(asset('img/mint/bigimage.png')) }}" class="bigimage" width="540" border="0" height="282" alt="" style="display:block; border:none; outline:none; text-decoration:none;">
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td width="100%" height="20"></td>
                        </tr>
                        <tr>
                          <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #333333; text-align:left;line-height: 20px;" st-title="rightimage-title">
                            {{ $event->title }} Event Update
                          </td>
                        </tr>
                        <tr>
                          <td width="100%" height="20"></td>
                        </tr>
                        <tr>
                          <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:left;line-height: 24px;" st-content="rightimage-paragraph">
                            @if( $event->organization != null )
                              <p>{{ $event->organization->name }} members, please be informed that you have an upcoming event this {{ date('M d, Y', strtotime($event->date_start)) }}
                              titled, <strong>{{ ucwords($event->title) }}</strong>. {{ $event->description }} held at {{ ucwords($event->venue) }}</p>
                            @else
                              <p>Please be informed that you have an upcoming event this {{ date('M d, Y', strtotime($event->date_start)) }}
                              titled, <strong>{{ ucwords($event->title) }}</strong>. {{ $event->description }} held at {{ ucwords($event->venue) }}</p>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <td width="100%" height="10"></td>
                        </tr>
                        <tr>
                          <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:left;line-height: 24px;" st-content="rightimage-paragraph">
                            @if( $event->organization != null )
                              <p>Please don't forget to click <em>Attend</em> Button on this event so that we can follow up your attendace</p>
                            @else
                              <p>Please don't forget See you.</p>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <td width="100%" height="10"></td>
                        </tr>
                        <tr>
                          <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:left;line-height: 24px;" st-content="rightimage-paragraph">
                            <p>See You</p>
                          </td>
                        </tr>
                        <tr>
                          <td width="100%" height="10"></td>
                        </tr>
                        <tr>
                          <td width="100%" height="10"></td>
                        </tr>
                        <tr>
                          <td width="100%" height="10"></td>
                        </tr>
                        <tr>
                          <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:left;line-height: 24px;" st-content="rightimage-paragraph">
                            <p>Best Regards</p>
                          </td>
                        </tr>
                        <tr>
                          <td width="100%" height="20"></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="block">
    <!-- Start of preheader -->
    <table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="postfooter">
      <tbody>
        <tr>
          <td width="100%">
            <table width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
              <tbody>
                <!-- Spacing -->
                <tr>
                  <td width="100%" height="5"></td>
                </tr>
                <!-- Spacing -->
                <tr>
                  <td align="center" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #999999" st-content="preheader">
                    If you don't want to receive updates. please  <a class="hlite" href="#" style="text-decoration: none; color: #0db9ea">unsubscribe</a>
                  </td>
                </tr>
                <!-- Spacing -->
                <tr>
                  <td width="100%" height="5"></td>
                </tr>
                <!-- Spacing -->
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- End of preheader -->
  </div>

</body>
</html>
