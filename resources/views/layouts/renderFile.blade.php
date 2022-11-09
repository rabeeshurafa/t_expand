<script>
    function attacheView(attach, formDataStr) {
        const shortCutName = attach.real_name;
        const shortCutID = attach.id;
        let urlFile = '';
        if (attach?.file_links?.ftp) {
            urlFile = attach?.file_links?.ftp
        } else if (attach?.file_links?.s3) {
            urlFile = attach?.file_links?.s3
        } else if (attach?.file_links?.dropbox) {
            urlFile = attach?.file_links?.s3
        } else {
            urlFile = `{{ asset('') }}/` + attach.url;
        }
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

    function attacheViewWithIcon(attach) {
        let shortCutName = attach.real_name;
        shortCutName = shortCutName.substring(0, 20);
        let urlFile = '';
        let fileImage = `{{ asset('assets/images/ico/file.png') }}`
        if (attach?.file_links?.ftp) {
            urlFile = attach?.file_links?.ftp
        } else if (attach?.file_links?.s3) {
            urlFile = attach?.file_links?.s3
        } else if (attach?.file_links?.dropbox) {
            urlFile = attach?.file_links?.s3
        } else {
            urlFile = `{{ asset('') }}/` + attach.url;
        }
        if (attach.extension === "jpg" || attach.extension === "png" || attach.extension === "jfif")
            fileImage = `{{ asset('assets/images/ico/image.png') }}`;
        else if (attach.extension === "pdf")
            fileImage = `{{ asset('assets/images/ico/pdf.png') }}`;
        else if (attach.extension === "doc" || attach.extension === "docx")
            fileImage = 'https://template.expand.ps/public/assets/images/ico/word.png';
        else if (attach.extension === "excel" || attach.extension === "xsc")
            fileImage = `{{ asset('assets/images/ico/excellogo.png') }}`;

        const view = `<div id="attach" class=" col-sm-6 ">
        <div class="attach">
         <a class="attach-close1" href="${urlFile}" style="color: #74798D; float:left;" target="_blank">
          <span class="attach-text hidemob">${shortCutName}</span>
            <img style="width: 20px;"src="${fileImage}">
        </a>
        </div>
        </div>`;
        return view;
    }
</script>
