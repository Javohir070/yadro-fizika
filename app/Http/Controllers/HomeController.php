<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Charter;
use App\Models\CouncilMember;
use App\Models\Department;
use App\Models\Doctoral;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\InstituteDirector;
use App\Models\InstituteHistory;
use App\Models\InstituteStructure;
use App\Models\Laboratory;
use App\Models\Leadership;
use App\Models\News;
use App\Models\Partner;
use App\Models\ScientificCouncil;
use App\Models\Stat;
use App\Models\Structure;
use App\Models\VideoGaller;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $sections = [
            ['label' => 'Bannerlar', 'permission' => 'Bannerlar', 'model' => Banner::class, 'route' => 'admin.banners.index'],
            ['label' => 'About', 'permission' => 'About', 'model' => About::class, 'route' => 'admin.abouts.index'],
            ['label' => 'Institut tarixi', 'permission' => 'Institut tarixi', 'model' => InstituteHistory::class, 'route' => 'admin.institute-histories.index'],
            ['label' => 'Institut nizomi', 'permission' => 'Institut nizomi', 'model' => Charter::class, 'route' => 'admin.charters.index'],
            ['label' => 'Institut direktorlari', 'permission' => 'Institut direktorlari', 'model' => InstituteDirector::class, 'route' => 'admin.institute-directors.index'],
            ['label' => 'Institut tuzilmasi', 'permission' => 'Institut tuzilmasi', 'model' => InstituteStructure::class, 'route' => 'admin.institute-structures.index'],
            ['label' => 'Laboratoriyalar', 'permission' => 'Laboratoriyalar', 'model' => Laboratory::class, 'route' => 'admin.laboratories.index'],
            ['label' => "Bo'limlar", 'permission' => "Bo'limlar", 'model' => Department::class, 'route' => 'admin.departments.index'],
            ['label' => 'Rahbariyat', 'permission' => 'Rahbariyat', 'model' => Leadership::class, 'route' => 'admin.leaderships.index'],
            ['label' => 'Yangiliklar', 'permission' => 'Yangiliklar', 'model' => News::class, 'route' => 'admin.news.index'],
            ['label' => 'Yangiliklar rasmlari', 'permission' => 'Yangiliklar rasmlari', 'model' => Image::class, 'route' => 'admin.images.index'],
            ['label' => 'Hamkorlar', 'permission' => 'Hamkorlar', 'model' => Partner::class, 'route' => 'admin.partners.index'],
            ['label' => 'Galereya', 'permission' => 'Galereya', 'model' => Gallery::class, 'route' => 'admin.galleries.index'],
            ['label' => 'Tashkilot tuzilmasi', 'permission' => 'Tashkilot tuzilmasi', 'model' => Structure::class, 'route' => 'admin.structures.index'],
            ['label' => 'Doktorantura', 'permission' => 'Doktorantura', 'model' => Doctoral::class, 'route' => 'admin.doctorals.index'],
            ['label' => 'Ilmiy kengash', 'permission' => 'Ilmiy kengash', 'model' => ScientificCouncil::class, 'route' => 'admin.scientific-councils.index'],
            ['label' => "Kengash a'zolari", 'permission' => "Kengash a'zolari", 'model' => CouncilMember::class, 'route' => 'admin.council-members.index'],
            ['label' => 'Video galereya', 'permission' => 'Video galereya', 'model' => VideoGaller::class, 'route' => 'admin.video-gallers.index'],
            ['label' => 'Statistika bloklari', 'permission' => 'Statistika bloklari', 'model' => Stat::class, 'route' => 'admin.stats.index'],
        ];

        $stats = collect($sections)
            ->filter(fn (array $section) => auth()->user()?->can($section['permission']))
            ->map(function (array $section) {
                $model = $section['model'];
                $instance = new $model;
                $table = $instance->getTable();
                $query = $model::query();

                $total = (clone $query)->count();
                $active = null;
                $inactive = null;

                if (Schema::hasColumn($table, 'is_active')) {
                    $active = (clone $query)->where('is_active', true)->count();
                    $inactive = max(0, $total - $active);
                }

                return [
                    'label' => $section['label'],
                    'route' => $section['route'],
                    'total' => $total,
                    'active' => $active,
                    'inactive' => $inactive,
                ];
            });

        return view('admin.home', compact('stats'));
    }
}
