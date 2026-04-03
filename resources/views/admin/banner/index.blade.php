@extends('layouts.admin')
@section('content')
    @include('admin.components.navbar_top', ['maniUrl' => 'Bannerlar'])
    <div class="mb-9">

        <div class="row g-3 mb-4">
            <div class="col-auto">
                <h2 class="mb-0">Bannerlar</h2>
            </div>
        </div>

        <div id="products">

            @include('admin.components.session')

            <div
                class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1 pt-4  pb-4">
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                    <table class="table table-report mt-2">
                        <thead>
                            <tr>
                                <th style="width: 40px;">ID</th>
                                <th>Title(UZ)</th>
                                <th>Holati</th>
                                <th class="text-end pe-8">Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($banners as $banner)
                                <tr>
                                    <td style="text-align: center;">
                                        {{ $banner->id }}   
                                    </td>
                                    <td>
                                        {{ $banner->title_uz }}
                                    </td>
                                    <td>
                                        {{ $banner->is_active ? 'Aktiv' : 'Nofaol' }}
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex align-items-center gap-2">
                                            <a href="{{ route('admin.banners.show', ['banner' => $banner->id]) }}"
                                                class="btn btn-outline-success" style="display: inline-block;padding:8px;">
                                                <span class="w-5 h-5 flex items-center justify-center">
                                                    <i data-feather="eye" class="w-4 h-4"></i>
                                                </span>
                                            </a>
                                            <a href="{{ url('admin/banners/' . $banner->id . '/edit') }}"
                                                class="btn btn-outline-primary" style="display: inline-block;padding:8px;">
                                                <span class="w-5 h-5 flex items-center justify-center">
                                                    <i data-feather="edit" class="w-4 h-4"></i>
                                                </span>
                                            </a>
                                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger  d-inline-flex align-items-center justify-content-center"
                                                    style="width: 36px; height: 36px;"
                                                    onclick="return confirm('Banner o\'chirilsinmi?')" title="O'chirish">
                                                    <span class="w-5 h-5 flex items-center justify-center">
                                                        <i data-feather="trash" class="w-4 h-4"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="text-body-tertiary mb-2">Bannerlar topilmadi</div>
                                        <a href="{{ route('admin.banners.create') }}"
                                            class="btn btn-primary btn-sm">Birinchi bannerni qo'shish</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card-footer bg-transparent border-0 pt-3 pb-3 d-flex justify-content-end">
                @if ($banners->hasPages())
                    {{ $banners->links() }}
                @endif
            </div>
        </div>


    </div>
@endsection
