<?php

namespace App\Imports;

use App\Models\Store;
use Maatwebsite\Excel\Concerns\ToModel;

class StoreImport implements ToModel
{
    protected $appId;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function setAppId($appId)
    {
        $this->appId = $appId;
        return $this;
    }
    public function startRow(): int
    {
        return 2; // Bắt đầu đọc từ dòng thứ 2 
    }

    public function model(array $row)
    {
        // Lấy giá trị app_id từ biến instance nếu có
        $appId = $this->appId;
        $startRow = $this->startRow();
        // Kiểm tra xem dòng có giá trị trong cột 'name' hay không
        if (!empty($row[0])) {
            Store::create([
                'name' => $row[0],
                'address' => $row[1],
                'app_id' => $appId
            ]);
        }
    
        return null;
    }
    
}
