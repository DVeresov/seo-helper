@extends('app')

@section('title', 'Структура сайта')
@section('description', 'Структура сайта с возможностью перейти на страницу редактирования')

@section('content')
    <h1>Структура страниц</h1>
    <p>Визуальное представление структуры и статуса страниц</p>
    <table>
        <thead>
        <tr>
            <td class="p-2">ID страницы</td>
            <td class="p-2">Title</td>
            <td class="p-2">ID parent</td>
            <td class="p-2">URL</td>
            <td class="p-2">Action</td>
        </tr>
        </thead>
        @foreach($structure as $page)
            <tbody>
            <tr>
                <td class="p-2">{{$page['id']}}</td>
                <td class="p-2">{{$page['pagetitle']}}</td>
                <td class="p-2">{{$page['parent']}}</td>
                <td class="p-2">{{$page['url']}}</td>
                <td class="p-2"><a href="/edit" class="text-primary hover:text-on-primary-fixed-variant font-label-md transition-colors flex items-center justify-end gap-1 ml-auto"><span class="material-symbols-outlined text-[16px]">edit</span>Edit</a></td>
            </tr>
            </tbody>
        @endforeach
    </table>
@endsection
