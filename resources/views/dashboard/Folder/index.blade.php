@extends('layouts.admin')

@section('search')

    <li class="dropdown dropdown-language nav-item hideMob">

        <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث"
               style="text-align: center;width: 350px; margin-top: 15px !important;">

    </li>

@endsection

@section('content')
    <style>
        .select2-container--classic .select2-selection--multiple .select2-selection__choice, .select2-container--default .select2-selection--multiple .select2-selection__choice {
            padding: 2px 6px !important;
            margin-top: 0 !important;
            background-color: #1E9FF2 !important;
            border-color: #1E9FF2 !important;
            color: #FFFFFF;
            margin-left: 8px !important;
            margin-bottom: 2px;
        }

        .preW {
            width: 40% !important;
        }

        .select2-container--default {
            width: 60% !important;
        }

        .width-95-per {
            width: 95% !important;
        }

        .width-96-per {
            width: 96% !important;
        }
    </style>


    <section class="horizontal-grid" id="horizontal-grid">
        <form id="ajaxform" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row white-row">
                <div class="col-sm-12 col-md-6">
                    <div class="card rightSide">
                        <div class="card-header">
                            <h4 class="card-title">
                                <img src="https://db.expand.ps/images/sponsor.png">
                                معلومات المجلد
                            </h4>
                        </div>
                        <meta name="csrf-token" content="{{ csrf_token() }}"/>
                        <div class="card-content collapse show">
                            <div class="card-body" style="padding-bottom: 0px;">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 pr-0 pr-s-12">
                                            <div class="form-group">
                                                <div class="input-group w-s-87">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        اسم المجلد
                                                        </span>
                                                    </div>
                                                    <input type="text" id="name"
                                                           class="form-control alphaFeild ac ui-autocomplete-input"
                                                           placeholder=" اسم المجلد "
                                                           name="name" autocomplete="off">
                                                </div>
                                                <input type="hidden" id="id" name="id" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        سنة
                                                        </span>
                                                    </div>
                                                    <input type="text" id="year1" class="form-control" name="year1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        شهر
                                                        </span>
                                                    </div>
                                                    <input type="text" id="month1" class="form-control" name="month1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        من
                                                        </span>
                                                    </div>
                                                    <input type="number" id="fromNo" class="form-control" name="fromNo"
                                                           oninput="setCount();">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        الي
                                                        </span>
                                                    </div>
                                                    <input type="number" id="toNo" class="form-control" name="toNo"
                                                           oninput="setCount();">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-12 pl-0" style="padding-left:2rem;">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        العدد
                                                        </span>
                                                    </div>
                                                    <input type="text" readonly id="count" class="form-control"
                                                           name="count">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        سنة
                                                        </span>
                                                    </div>
                                                    <input type="text" id="year2" class="form-control" name="year2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        شهر
                                                        </span>
                                                    </div>
                                                    <input type="text" id="month2" class="form-control" name="month2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-9 col-md-12 pr-0 pr-s-12">
                                            <div class="form-group">
                                                <div class="input-group w-s-87 width-95-per">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        مكان المجلد
                                                        </span>
                                                    </div>
                                                    <input type="text" id="place"
                                                           class="form-control"
                                                           placeholder=" مكان المجلد "
                                                           name="place" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        الترميز
                                                        </span>
                                                    </div>
                                                    <input type="text" id="encoding" class="form-control"
                                                           name="encoding">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 pr-0 pr-s-12">
                                            <div class="form-group">
                                                <div class="input-group w-s-87 width-96-per">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        ملاحظات
                                                        </span>
                                                    </div>
                                                    <input type="text" id="notes"
                                                           class="form-control"
                                                           placeholder=" مكان المجلد "
                                                           name="notes" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @can('folder_archives')
                            <div class="card-header" style="padding-top:0px;">
                                <h4 class="card-title">
                                    <img src="{{asset('assets/images/ico/msg.png')}}" width="32" height="32">
                                    {{trans('admin.archieve')}}
                                </h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body" style="padding-bottom: 0px;">
                                    <div class="row" style="text-align: center">
                                        <div class="col-md-2 w-s-50" style="padding: 0px;">
                                            <div class="form-group">
                                                <img src="{{asset('assets/images/ico/msg.png')}}"
                                                     onclick="$('#ArchModalName').html($('.ac').val());$('#msgModal').modal('show')"
                                                     style="cursor:pointer">
                                                <div class="form-group">
                                                    <a onclick="$('#ArchModalName').html($('.ac').val());$('#msgModal').modal('show')"
                                                       style="color:#000000">{{trans('admin.archieve')}}
                                                        <span id="msgStatic" style="color:#1E9FF2"><b>(0)</b></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>

                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="card leftSide" style="min-height:532.375px">
                        <div class="card-header">
                            <h4 class="card-title">
                                <img src="https://db.expand.ps/images/maps-icon.png" width="32" height="32">
                                {{trans('admin.address')}}
                            </h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                @include('dashboard.component.address')
                                <div class="form-actions" style="border-top:0px;">
                                    <div class="text-right">
                                        @can('edit_model')
                                            <button id="editBtn" style="display:none" class="btn btn-primary save-data">
                                                تعديل<i class="ft-thumbs-up position-right"></i></button>
                                        @endcan
                                        <button id="saveBtn" class="btn btn-primary save-data">{{trans('admin.save')}}
                                            <i class="ft-thumbs-up position-right"></i></button>
                                        <button type="reset" onclick="$('#id').val('')"
                                                class="btn btn-warning  reset-data">
                                            {{trans('assets.reset')}}
                                            <i class="ft-refresh-cw position-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    @include('dashboard.component.folder_archive')
    @include('dashboard.component.fetch_table')
@stop

@section('script')

    <script>
      function setCount() {
        if ($('#fromNo').val() !== null && $('#toNo').val() !== null) {
          $('#count').val((+$('#toNo').val() ?? 0) - (+$('#fromNo').val() ?? 0));
        } else {
          $('#count').val('');
        }
      }

      $('.reset-data').click(function (event) {
        $("#msgStatic").html("(0)");
      });

      $(function () {
        $(".ac").autocomplete({
          source: "{{route('folderAutoComplete')}}",
          minLength: 1,
          select: function (event, ui) {
            update(ui.item.id);
          }
        });
      });

      function update($id) {
        $('#saveBtn').css('display', 'none');
        $('#editBtn').css('display', 'inline-block');
        $.ajax({
          type: 'get',
          url: "{{route('getFolder')}}",
          data: {
            id: $id,
          },
          success: function (response) {
            $('#encoding').val(response?.encoding);
            $('#fromNo').val(response?.fromNo);
            $('#id').val(response?.id);
            $('#month1').val(response?.month1);
            $('#month2').val(response?.month2);
            $('#name').val(response?.name);
            $('#notes').val(response?.notes);
            $('#place').val(response?.place);
            $('#toNo').val(response?.toNo);
            $('#total').val(response?.total);
            $('#year1').val(response?.year1);
            $('#year2').val(response?.year2);
            $archiveCount=0;
              @can('folderContractArchive')
                getContractArchive($id, response.contract);
                $archiveCount += response.contract;
              @endcan

              @can('folderOutArchive')
                getOutArchive($id, response.out);
                $archiveCount += response.out;
              @endcan

              @can('folderInArchive')
                getInArchive($id, response.in);
                $archiveCount += response.in;
              @endcan

              @can('folderCopyArchive')
                getCopyArchive($id, response.copy);
                $archiveCount += response.copy;
              @endcan

              @can('folderJalArchive')
                getJalArchive($id, response.agenda);
                $archiveCount += response.agenda;
              @endcan

              @can('folderOtherArchive')
                getOtherArchive($id, response.other);
                $archiveCount += response.other;
              @endcan

              @can('folderFinanceArchive')
                getFinanceArchive($id, response.finance);
                $archiveCount += response.finance;
              @endcan
              $("#msgStatic").html("(" + $archiveCount + ")");
            if (response?.fromNo !== null && response?.toNo !== null) {
              $('#count').val((+response?.toNo ?? 0) - (+response?.fromNo ?? 0));
            } else {
              $('#count').val('');
            }
            window.scrollTo(0, 0);
          },

        });

      }

      $(document).ready(function () {
        $('#ajaxform').submit(function (e) {
          e.preventDefault();
          if ($('#name').val().trim().length <= 0) {
            $('#name').addClass('error');
            $(`#name`).on('input', function () {
              if ($(`#name`).val().trim().length > 0) {
                this.setCustomValidity('');
                $(`#name`).removeClass('error');
              } else {
                this.setCustomValidity('يرجي ادخال اسم المجلد');
              }
            })
            return false;
          }
          $(".loader").removeClass('hide');
          $(".form-actions").addClass('hide');
          let formData = new FormData(this);
          $.ajax({
            type: 'POST',
            url: "{{route('storefolder')}}",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
              $(".form-actions").removeClass('hide');
              $(".loader").addClass('hide');
              if (response.status) {
                $('.wtbl').DataTable().ajax.reload();
                Swal.fire({
                  position: 'top-center',
                  icon: 'success',
                  title: '{{ trans('admin.data_added') }}',
                  showConfirmButton: false,
                  timer: 1500
                })
                $('#id').val('');
                $("#ajaxform")[0].reset();
              } else {
                Swal.fire({
                  position: 'top-center',
                  icon: 'error',
                  title: '{{trans('admin.error_save')}}',
                  showConfirmButton: false,
                  timer: 1500
                })
              }

            },
            error: function (response) {
              $(".loader").addClass('hide');
              $(".form-actions").removeClass('hide');
              Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: '{{ trans('admin.error_save') }}',
                showConfirmButton: false,
                timer: 1500
              })
            }
          });
        });
      });


      function delete_folder($id) {
        if (confirm('هل انت متاكد من حذف المجلد؟ لن يمكنك استرجاعها فيما بعد')) {
          var _token = '{{ csrf_token() }}';
          $.ajax({
            type: 'post',
            // the method (could be GET btw)
            url: "{{route('deleteFolder')}}",
            data: {
              id: $id,
              _token: _token,
            },

            success: function (response) {
              $(".loader").addClass('hide');
              $('.wtbl').DataTable().ajax.reload();
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'تم الحذف بنجاح',
                showConfirmButton: false,
                timer: 1500
              })
            },

            error: function (response) {
              $(".loader").addClass('hide');
              Swal.fire({
                position: 'top-center',
                title: 'خطأ فى عملية الحذف',
                showConfirmButton: false,
                timer: 1500
              })

            }
          });
          return true;
        }
        return false;
      }

    </script>

@endsection

