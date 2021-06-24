<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/24
 * Time: 12:35 上午
 */


namespace RmTop\RmExpress\command;


use RmTop\RmExpress\lib\PublishFile;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Exception;

class PublishExpressFile extends Command
{


    protected function configure()
    {
        $this->setName('rmtop:publish_express')
            ->setDescription('publish_express ');
    }


    /**
     * 执行数据
     * @param Input $input
     * @param Output $output
     * @return int|void|null
     */
    protected function execute(Input $input, Output $output)
    {

        try{
            PublishFile::PublishFileToSys($output);//发布文件
            $output->writeln("all publish successfully！");
        }catch (Exception $exception){
            $output->writeln($exception->getMessage());
        }

    }


}