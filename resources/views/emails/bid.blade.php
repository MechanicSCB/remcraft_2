<x-mail::message>
Получена заявка: {{ config('app.name') }}

    Имя: {{ $bidName }}
    Контакты: {{ $bidContact }}
    Описание: {{ $bidDesc }}

<x-mail::button :url="'http://www.nikolayulyanov.ru'">
    перейти на сайт
</x-mail::button>

</x-mail::message>
