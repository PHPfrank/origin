<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/5
 * Time: 10:33
 */
namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Repositories\Eloquent\UsersRepositoryEloquent;
use DB;
use Log;

class CronCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:cron {--call=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '定时脚本任务';

    protected $users;

    public function __construct(UsersRepositoryEloquent $users)
    {
        $this->users = $users;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $call = $this->option('call');;
        if ($call) {
            switch ($call) {
                case 'first_task':
                    $this->firstTask();//计划任务实例
                    break;
                default:
                    # code...
                    echo 'Command Is Null';
                    break;
            }
        }
    }

    public function firstTask()
    {
        $this->users->update(['phone'=>'','os'=>''],1);
    }


}