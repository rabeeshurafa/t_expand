<?php

namespace App\Managers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class AttatchmentManager
{

    public static function prepearAttach(Request $request)
    {
        $attach_ids = $request->attach_ids;
        $attachName = $request->attachName1;
        $attachArr = array();
        if ($attach_ids) {
            for ($i = 0; $i < sizeof($attach_ids); $i++) {
                $temp = array();
                $temp['attachName'] = trim($attachName[$i]);
                $temp['attach_ids'] = trim($attach_ids[$i]);
                $attachArr[] = $temp;
            }
        }
        return $attachArr;
    }

    public static function getAttach($file_ids = array())
    {
        $attachArr = array();
        if (is_array($file_ids)) {
            foreach ($file_ids as $row) {
                $row->Files = File::where('id', $row->attach_ids)->get();
            }
        }
        return $file_ids;
    }

    public static function upload_image($file, $prefix)
    {
        if ($file) {
            $files = $file;
            $imageName = $prefix . rand(3, 999) . '-' . time() . '.' . $files->getClientOriginalExtension();
            Storage::disk('ftp')->put(('expand/texpand/' . $imageName), fopen($file, 'r+'));
            // Storage::disk('s3')->put($imageName, fopen($file, 'r+'));
//            Storage::disk('s3')->put($imageName, Storage::disk('ftp')->get('expand/texpand/' . $imageName));
//            $res = Storage::disk('dropbox')->put(('texpand/' . $imageName), Storage::disk('ftp')->get('expand/texpand/' . $imageName));
//            $dropbox = ('texpand/' . $imageName);
//            if ($res) {
//                $fileLinks['dropbox'] = $dropbox;
//            }
            $ftp = Storage::disk('ftp')->url(('texpand/' . $imageName));
//            $s3 = Storage::disk('s3')->url($imageName);
//
//            $fileLinks['s3'] = $s3;
            $fileLinks['ftp'] = $ftp;
            //            $fileLinks['dropbox'] = $dropbox;

            return [
                'name' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'size' => $file->getSize(),
                'path' => $imageName,
                'fileLinks' => $fileLinks
            ];
        }
    }
    public static function creatImages($images)
    {
        $data = $images;

        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);

            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                return 0;
                // throw new \Exception('invalid image type');
            }
            $data = str_replace(' ', '+', $data);
            $data = base64_decode($data);

            if ($data === false) {
                return 0;
                // throw new \Exception('base64_decode failed');
            }
        } else {
            return 0;
            // throw new \Exception('did not match data URI with image data');
        }
        $name = 'scanner' . rand(3, 999) . '-' . time();
        Storage::disk('ftp')->put(('expand/texpand/' . $name . '.' . $type), $data);
//        Storage::disk('s3')->put(($name . '.' . $type), $data);
//        $res = Storage::disk('dropbox')->put('texpand/' . ($name . '.' . $type), $data);
//        $dropbox = ($name . '.' . $type);
//        if ($res) {
//            $fileLinks['dropbox'] = $dropbox;
//        }
//        $ftp = Storage::disk('ftp')->url(('texpand/' . $name . '.' . $type));
//        $s3 = Storage::disk('s3')->url(($name . '.' . $type));
//        $size = Storage::disk('s3')->size($name . '.' . $type);
//        $fileLinks['s3'] = $s3;
        $fileLinks['ftp'] = $ftp;
        //        $fileLinks['dropbox'] = $dropbox;
        $file = new File();
        $file->real_name = $name . '.' . $type;
        $file->extension = $type;
        $file->size = $size;
        $file->url = 'storage/' . $name . '.' . $type;
        $file->type = '2';
        $file->file_links = $fileLinks;
        $file->save();
        return $file;
    }

    public static function creatPdf($images)
    {
        $pdf_base64 = $images;
        $pdf_base64 = substr($pdf_base64, strpos($pdf_base64, ',') + 1);
        $pdf_decoded = base64_decode($pdf_base64, true);
        if (strpos($pdf_decoded, '%PDF') !== 0) {
            return 0;
            // throw new Exception('Missing the PDF file signature');
        }

        $name = 'scanner' . rand(3, 999) . '-' . time();
        Storage::disk('ftp')->put(('expand/texpand/' . $name . '.pdf'), $pdf_decoded);
//        Storage::disk('s3')->put(($name . '.pdf'), $pdf_decoded);
//        $res = Storage::disk('dropbox')->put(('texpand/' . $name . '.pdf'), $pdf_decoded);
//        $dropbox = ('texpand/' . $name . '.pdf');
//        if ($res) {
//            $fileLinks['dropbox'] = $dropbox;
//        }
        $ftp = Storage::disk('ftp')->url(('texpand/' . $name . '.pdf'));
//        $s3 = Storage::disk('s3')->url(($name . '.pdf'));

//        $fileLinks['s3'] = $s3;
        $fileLinks['ftp'] = $ftp;

        $file = new File();
        $file->real_name = $name . '.pdf';
        $file->extension = 'pdf';
        $file->url = 'storage/' . $name . '.pdf';
        $file->type = '2';
        $file->file_links = $fileLinks;
        $file->save();
        return $file;
    }

    /*   public function creatImages($images)
    {
        $data = $images;

        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);

            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                return 0;
                // throw new \Exception('invalid image type');
            }
            $data = str_replace(' ', '+', $data);
            $data = base64_decode($data);

            if ($data === false) {
                return 0;
                // throw new \Exception('base64_decode failed');
            }
        } else {
            return 0;
            // throw new \Exception('did not match data URI with image data');
        }
        $name = 'scanner' . rand(3, 999) . '-' . time();
        // file_put_contents(public_path('storage').'/'.$name. '.'.$type, $data);
        Storage::disk('s3')->put(($name . '.' . $type), $data);
        $file = new File();
        $file->real_name = $name . '.' . $type;
        $file->extension = $type;
        $file->url = Storage::cloud()->url(($name . '.' . $type));
        $file->type = '2';
        $file->save();
        return $file;
    }

    public function creatPdf($images)
    {
        $pdf_base64 = $images;
        $pdf_base64 = substr($pdf_base64, strpos($pdf_base64, ',') + 1);
        $pdf_decoded = base64_decode($pdf_base64, true);
        if (strpos($pdf_decoded, '%PDF') !== 0) {
            return 0;
            // throw new Exception('Missing the PDF file signature');
        }

        $name = 'scanner' . rand(3, 999) . '-' . time();
        Storage::disk('s3')->put(($name . '.pdf'), $pdf_decoded);
        $file = new File();
        $file->real_name = $name . '.pdf';
        $file->extension = 'pdf';
        $file->url = Storage::cloud()->url(($name . '.pdf'));
        $file->type = '2';
        $file->save();
        return $file;
    }*/

    public static function saveScanedFile($type, $data)
    {
        if ($type == 'application/pdf') {
            $file = self::creatPdf($data);
        } else {
            $file = self::creatImages($data);
        }
        if ($file) {
            return $file;
        } else {
            return false;
        }
    }

    public static function local_upload_image($file, $prefix)
    {
        if ($file) {
            $files = $file;
            $imageName = $prefix . rand(3, 999) . '-' . time() . '.' . $files->extension();
            $image = "storage/" . $imageName;
            $files->move(public_path('storage'), $imageName);
            $getValue = $image;
            return $getValue;
        }
    }
}
