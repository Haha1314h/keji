<?php
namespace App\Http\Controllers; use App\System; use Illuminate\Http\Request; use Illuminate\Support\Facades\Log; use Illuminate\Support\Facades\Mail; class DevController extends Controller { private function check_readable_r($sp3558b8) { if (is_dir($sp3558b8)) { if (is_readable($sp3558b8)) { $sp1e6e2c = scandir($sp3558b8); foreach ($sp1e6e2c as $sp0879d3) { if ($sp0879d3 != '.' && $sp0879d3 != '..') { if (!self::check_readable_r($sp3558b8 . '/' . $sp0879d3)) { return false; } else { continue; } } } echo $sp3558b8 . '   ...... <span style="color: green">R</span><br>'; return true; } else { echo $sp3558b8 . '   ...... <span style="color: red">R</span><br>'; return false; } } else { if (file_exists($sp3558b8)) { return is_readable($sp3558b8); } } echo $sp3558b8 . '   ...... 文件不存在<br>'; return false; } private function check_writable_r($sp3558b8) { if (is_dir($sp3558b8)) { if (is_writable($sp3558b8)) { $sp1e6e2c = scandir($sp3558b8); foreach ($sp1e6e2c as $sp0879d3) { if ($sp0879d3 != '.' && $sp0879d3 != '..') { if (!self::check_writable_r($sp3558b8 . '/' . $sp0879d3)) { return false; } else { continue; } } } echo $sp3558b8 . '   ...... <span style="color: green">W</span><br>'; return true; } else { echo $sp3558b8 . '   ...... <span style="color: red">W</span><br>'; return false; } } else { if (file_exists($sp3558b8)) { return is_writable($sp3558b8); } } echo $sp3558b8 . '   ...... 文件不存在<br>'; return false; } private function checkPathPermission($spe59991) { self::check_readable_r($spe59991); self::check_writable_r($spe59991); } public function install() { $sp28bfaf = array(); @ob_start(); self::checkPathPermission(base_path('storage')); self::checkPathPermission(base_path('bootstrap/cache')); $sp28bfaf['permission'] = @ob_get_clean(); return view('install', array('var' => $sp28bfaf)); } public function test(Request $sp13451b) { } }