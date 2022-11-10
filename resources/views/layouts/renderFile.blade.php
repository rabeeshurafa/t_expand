<script>
    function getFileUrl(attach) {
        if (attach?.file_links?.ftp) {
            return attach?.file_links?.ftp
        } else if (attach?.file_links?.s3) {
            return attach?.file_links?.s3
        } else if (attach?.file_links?.dropbox) {
            return attach?.file_links?.dropbox
        } else {
            return `{{ asset('') }}` + attach.url;
        }
    }
    function getIcon(extension){
        let fileImage = `{{ asset('assets/images/ico/file.png') }}`
        if (extension === "jpg" || extension === "png" || extension === "jfif")
            fileImage = `{{ asset('assets/images/ico/image.png') }}`;
        else if (extension === "pdf")
            fileImage = `{{ asset('assets/images/ico/pdf.png') }}`;
        else if (extension === "doc" || extension === "docx")
            fileImage = 'https://template.expand.ps/public/assets/images/ico/word.png';
        else if (extension === "excel" || extension === "xsc")
            fileImage = `{{ asset('assets/images/ico/excellogo.png') }}`;
        return fileImage;
    }
    function attacheView(attach, formDataStr) {
        const shortCutName = attach.real_name;
        const shortCutID = attach.id;
        let urlFile = getFileUrl(attach);
        view = `<div id="attach" class=" col-lg-6">
           <div class="attach" onmouseover="$(this).children().first().next().show()">
           <a class="attach-close1" href="${urlFile}" style="color: #74798D;" target="_blank">
           <span class="attach-text">${shortCutName}</span> </a>
           <a class="attach-close1" style="color: #74798D; float:left;" onclick="$(this).parent().parent().remove()">×</a>
              <input type="hidden" id="${formDataStr}imgUploads[]" name="${formDataStr}imgUploads[]" value="${shortCutName}">
                 <input type="hidden" id="${formDataStr}orgNameList[]" name="${formDataStr}orgNameList[]" value="${shortCutName}">
                 <input type="hidden" id="${formDataStr}orgIdList[]" name="${formDataStr}orgIdList[]" value="${shortCutID}">
            </div>
          </div>`
        return view;
    }

    function attacheViewWithIcon(attach, fileWidth = 6, attachName = null) {
        let shortCutName = attach.real_name;
        shortCutName = shortCutName.substring(0, 20);
        let urlFile = getFileUrl(attach);
        let fileImage = getIcon(attach.extension);

        const view = `<div id="attach" class="col-sm-${fileWidth}">
        <div class="attach">
         <a class="attach-close1 otherattache" href="${urlFile}" style="color: #74798D; float:left;" target="_blank">
          <span class="attach-text hidemob">${(attachName ?? shortCutName)}</span>
            <img style="width: 20px;"src="${fileImage}">
        </a>
        <input type="hidden" id="attach_ids[]" name="attach_ids[]" value="${attach.id}">
        </div>
        </div>`;
        return view;
    }

    function attacheWithAttachName(attach, name) {
        const row = `<div class="col-sm-12"><div class="form-group">
              <div class="input-group w-s-87">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                          {{ trans('archive.attachment_type') }}
                        </span>
                    </div>
                    <input type="text" id="attachName[]" class="form-control" name="attachName[]" value="${name}">
                  <input type="hidden" id="attachFile[]" name="attachFile[]" value="${attach.url}">
                  <input type="hidden" id="attachFile_id[]" name="attachFile_id[]" value="${attach.id}">
                  <a href="${getFileUrl(attach)}" target="_blank">
                      <span class="input-group-text input-group-text2">
                          <i class="fa fa-download"></i>
                      </span>
                  </a>
                  <a onclick="$(this).parent().parent().remove()">
                      <span class="input-group-text input-group-text2">
                          <i class="fa fa-trash"></i>
                      </span>
                  </a>
             </div>
            </div>
            </div>`
        return row;
    }

    function meetingAttache(attach,index) {
        let fileImage = getIcon(attach.Files[0].extension);
        let shortCutName = attach.Files[0].real_name;
        shortCutName = shortCutName.substring(0, 32);
        let urlFile = getFileUrl(attach.Files[0]);
        return `<li style="font-size: 17px !important;color:#000000">
                    <div class="row">
                        <div class="col-sm-6">
                      <input type="text" required="" id="attachName[]" name="attachName[]" class="form-control attachName" value="${attach.attachName}">
                        </div>
                        <div class="col-sm-5 attach_row_${index + 1}">
                            <div id="attach" class=" col-sm-12 ">
                                <div class="attach">
                                    <a class="" href="${urlFile}" style="color: #74798D; float:left;"
                                    target="_blank">
                                        <span class="attach-text">${shortCutName}</span>
                                        <img style="width: 20px;" src='${fileImage}'>
                                    </a>
                                    <input type="hidden" id="attach_ids[]" name="attach_ids[]" value="${attach.attach_ids}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1 attachs">
                            <i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>
                        </div>
                    </div>
                </li>`;
    }

    function meetingNewScannedAttache(attach,index){
        let fileImage = getIcon(attach.extension);
        let urlFile = getFileUrl(attach);
        let shortCutName = attach.real_name;
        shortCutName = shortCutName.substring(0, 32);
        return `<li style="font-size: 17px !important;color:#000000">
                    <div class="row">
                        <div class="col-sm-6 attmob">
                            <input type="text" required id="attachName[]" name="attachName[]" class="form-control attachName">
                        </div>
                        <div class="attdocmob col-sm-5 attach_row_${index}">
                        <div id="attach" class=" col-sm-12 ">
                            <div class="attach">
                                <a class="attach-close1" href="${urlFile}" style="color: #74798D; float:left;" target="_blank">
                                    <span class="attach-text hidemob">${shortCutName}</span>
                                    <img style="width: 20px;"src="${fileImage}">
                                </a>
                                <input type="hidden" id="attach_ids[]" name="attach_ids[]" value="${attach.id}">
                            </div>
                        </div>
                    </div>
                    <div class="attdelmob">
                        <img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$('#currFile').val(${index});$('#attachfile').trigger('click'); return false">
                    </div>
                    <div class="attdelmob">
                        <i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>
                    </div>
                </div>
             </li>`;
    }

    function topicAttache(attach,topicId){
        let fileImage = getIcon(attach.extension);
        let urlFile = getFileUrl(attach);
        let shortCutName = attach.real_name;
        shortCutName = shortCutName.substring(0, 40)
        const view = `<div id="attach" class=" col-sm-6 ">
                          <div class="attach" onmouseover="$(this).children().first().next().show()">
                                <a class="attach-close1" href="${urlFile}" style="color: #74798D;" target="_blank">
                                    <span class="attach-text">${shortCutName}</span>
                                </a>
                                <img style="width: 20px;float:left;margin: 2px"src="${fileImage}">
                                <a class="attach-close1" style="color: #74798D; float:left;" onclick="$(this).parent().parent().remove()">×</a>
                                <input type="hidden" id="subject${topicId}imgUploads[]" name="subject${topicId}imgUploads[]" value="${attach.real_name}">
                                <input type="hidden" id="subject${topicId}id[]" name="subject${topicId}id[]" value="${attach.id}">
                          </div>
                        </div>`;
        return view;
    }

    function ticketScannedAttache(attach,index,addNotArchivedInput = false){
        let fileImage = getIcon(attach.extension);
        let urlFile = getFileUrl(attach);
        let shortCutName = attach.real_name;
        shortCutName = shortCutName.substring(0, 40);
        return `<li style="font-size: 17px !important;color:#000000">
                    <div class="row">
                        <div class="col-sm-5 attmob">
                            <input type="text" required id="attachName[]" name="attachName[]" class="form-control attachName">
                        </div>
                        <div class="attdocmob col-sm-5 attach_row_${index}">
                            <div id="attach" class=" col-sm-12 ">
                                <div class="attach">
                                    <a class="attach-close1" href="${urlFile}" style="color: #74798D; float:left;" target="_blank">
                                        <span class="attach-text hidemob">${shortCutName}</span>
                                        <img style="width: 20px;"src="${fileImage}">
                                    </a>
                                    <input type="hidden" id="attach_ids[]" name="attach_ids[]" value="${attach.id}">
                                    ${addNotArchivedInput?`<input type="hidden" id="notArchived[]" name="notArchived[]" value="${attach.id}">`:''}
                                </div>
                            </div>
                        </div>
                        <div class="attdelmob">
                            <img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$('#currFile').val(${index});$('#attachfile').trigger('click'); return false">
                        </div>
                        <div class="attdelmob">
                            <i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>
                        </div>
                    </div>
                </li>`;
    }

    function ticketNormalAttache(attach) {
        let fileImage = getIcon(attach.extension);
        let urlFile = getFileUrl(attach);
        let shortCutName = attach.real_name;
        shortCutName = shortCutName.substring(0, 40);
        return `<div id="attach" class=" col-sm-12 ">
                    <div class="attach">
                        <a class="attach-close1" href="${urlFile}" style="color: #74798D; float:left;" target="_blank">
                            <span class="attach-text hidemob">${shortCutName}</span>
                            <img style="width: 20px;"src="${fileImage}">
                        </a>
                        <input type="hidden" id="attach_ids[]" name="attach_ids[]" value="${attach.id}">
                    </div>
                 </div>`
    }

    function scannedReplayAttache(attach,index) {
        let fileImage = getIcon(attach.extension);
        let urlFile = getFileUrl(attach);
        let shortCutName = attach.real_name;
        shortCutName = shortCutName.substring(0, 40);
        return `
            <li style="font-size: 17px !important;color:#000000">
                <div class="row">
                    <div class="col-sm-6 attmob">
                        <input type="text" required id="attachName1[]" name="attachName1[]" class="form-control attachName1">
                    </div>
                    <div class="attdocmob col-sm-5 attach_row_${index}">
                        <div id="attach" class=" col-sm-12 ">
                            <div class="attach">
                                <a class="attach-close1" href="${urlFile}" style="color: #74798D; float:left;" target="_blank">
                                    <span class="attach-text hidemob">${shortCutName}</span>
                                    <img style="width: 20px;"src="${fileImage}">
                                </a>
                                <input type="hidden" id="attach_ids[]" name="attach_ids[]" value="${attach.id}">
                                <input type="hidden" id="notArchived1[]" name="notArchived1[]" value="${attach.id}">
                            </div>
                        </div>
                    </div>
                    <div class="attdelmob">
                        <img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$('#currFile').val(${index});$('#attachfile').trigger('click'); return false">
                        <i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>
                    </div>
                </div>
            </li>
        `
    }

    function replayNormalAttache(attach) {
        let fileImage = getIcon(attach.extension);
        let urlFile = getFileUrl(attach);
        let shortCutName = attach.real_name;
        shortCutName = shortCutName.substring(0, 40);
        return `
                <div id="attach" class=" col-sm-12 ">
                    <div class="attach">
                        <a class="attach-close1" href="${urlFile}" style="color: #74798D; float:left;" target="_blank">
                            <span class="attach-text hidemob">${shortCutName}</span>
                            <img style="width: 20px;"src="${fileImage}">
                        </a>
                        <input type="hidden" id="attach_ids[]" name="attach_ids[]" value="${attach.id}">
                        <input type="hidden" id="notArchived1[]" name="notArchived1[]" value="${attach.id}">
                    </div>
                </div>
        `
    }
</script>
