<?php

namespace Crystoline\LaraShell\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CmdToolController extends Controller
{
    private $composer_path;
    public function __construct()
    {
        $this->composer_path = dirname(__DIR__).'/composer.phar';
    }

    public function index(){

		return $this->view();

	}

    private function getComposer(){
        if(!is_file($this->composer_path)) {
            $stream = file_get_contents('https://getcomposer.org/composer.phar');
            if (!empty($stream)) {
                file_put_contents($this->composer_path, $stream);
            }
        }
    }

    private function replaceComposer($string){
        $this->getComposer();
        $composer_dir = __DIR__;
        if(strpos($string,  'composer ') !== false) {
            putenv("COMPOSER_HOME=$composer_dir");
            return $string = str_replace('composer ', "php {$this->composer_path} ", $string);
        }
        return $string;
    }

	public function exec(Request $request){
        $extra = '';
        $output = '';

	    if( $request->input('type') == 'shell' ){
            $cmds = $request->input('cmd');
            $cmds =  $this->replaceComposer($cmds);
	        $cmd_array = explode("\n", $cmds);
            $cmd_new = [];
            $out = [];
	        foreach ($cmd_array as $value){
	            $c =  trim($value);
	            if($c){

                    $cmd_new[] = escapeshellcmd($c);
                }
            }
            $seperator = windows_os()? '&&': ';';
            $cmd= implode(" {$seperator} ", $cmd_new);
	        if($cmd){
                //passthru($cmd, $output);
	            ob_start();
                system($cmd);
                $output = ob_get_clean();
            }else{
                $output = 'No command';
            }
            //$output = ($cmd)? `$cmd` : 'No command';
            print $this->composer_path;
            $extra = implode("\n", $cmd_new);

        }
		elseif($request->input('cmd') or ($request->input('param') and $request->input('paramValue')) ) {


            $params = [];
			$vs = $request->input('paramValue');
			$ps = $request->input('param');
			if(!empty($ps) and !empty($vs)){
				foreach($ps as $i =>$p){
					if(empty($vs[$i])) continue;
					@$params[$p] = $vs[$i];
				}
			}
			try{
                ob_start();
				Artisan::call($request->input('cmd'), $params);
                ob_get_clean();
				$output = Artisan::output();

			}catch (\Exception $exception){
				$output = $exception->getMessage();
			}
           // return '<pre style="font-family: monospace; background-color: black; color: white;">'.$output.'</pre>';
        }
        return view('larashell::exec', compact(['output' , 'extra']));
    }

	private function view(){
        return view('larashell::index');
	}
}