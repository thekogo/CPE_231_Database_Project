<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_method',
        'payment_date',
        'payment_status',
        'receipt_img',
        'enroll_date',
        'user_id',
        'course_id'
    ];

    private $mapMethodToDB = [
        'เงินสด' => 'offline',
        'ช่องทางออนไลน์' => 'online',
    ];

    private $mapDBToMethod = [
        'offline' => 'เงินสด',
        'online' => 'ช่องทางออนไลน์',
    ];

    public function setPaymentMethodAttribute($value)
    {
        $this->attributes['payment_method'] = $this->mapMethodToDB[$value];
    }

    public function getPaymentMethodAttribute($value)
    {
        return $this->mapDBToMethod[$value];
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    private $mapStatusToDB = [
        'ชำระเงินเรียบร้อย' => 'success',
        'รอดำเนินการ' => 'pending',
        'ขอคืนเงิน' => 'refund',
    ];

    private $mapDBToStatus = [
        'success' => 'ชำระเงินเรียบร้อย',
        'pending' => 'รอดำเนินการ',
        'refund' => 'ขอคืนเงิน',
    ];

    public function setPaymentStatusAttribute($value)
    {
        $this->attributes['payment_status'] = $this->mapStatusToDB[$value];
    }

    public function getPaymentStatusAttribute($value)
    {
        return $this->mapDBToStatus[$value];
    }

    public function getReceiptImgAttribute($value)
    {
        return "/storage/" . str_replace("public/", "", $value);
    }

    public static function createReceiptImg(UploadedFile $file)
    {
        return $file->store(
            '/public/receipt_img'
        );
    }

    public $timestamps = false;
}
