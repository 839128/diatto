<?php

namespace app\project\controller;

use controller\BasicApi;
use think\facade\Request;

/**
 */
class SourceLink extends BasicApi
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->model) {
            $this->model = new \app\common\Model\SourceLink();
        }
    }


    /**
     * 删除资源
     * @return void
     * @throws \Exception
     */
    public function delete()
    {
        $code = Request::post('sourceCode');
        if (!$code) {
            $this->error("资源不存在");
        }
        $this->model->deleteSource($code);
        $this->success('');
    }
}
