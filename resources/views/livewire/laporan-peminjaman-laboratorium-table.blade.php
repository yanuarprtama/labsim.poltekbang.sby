<div>
    <div class="d-flex justify-content-between align-items-center fs-1">
        <div class="btn" wire:click="decreaseMonthNavigation">
            <i class="bi bi-arrow-left-short fs-1"></i>
        </div>
        <div class="d-flex align-items-center">
            <h1 class="mb-3 text-uppercase">{{ $month }}</h1>
        </div>
        <div wire:click="increaseMonthNavigation" class="btn">
            <i class="bi bi-arrow-right-short fs-1"></i>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center fs-1">
        <div class="btn" wire:click="decreaseYearNavigation">
            <i class="bi bi-arrow-left-short fs-2"></i>
        </div>
        <div class="d-flex align-items-center">
            <h3 class="mb-3 text-uppercase">{{ $year }}</h3>
        </div>
        <div wire:click="increaseYearNavigation" class="btn">
            <i class="bi bi-arrow-right-short fs-2"></i>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Laboratorium</th>
                    @foreach ($totalDays as $row)
                        <th scope="col">{{ $row }}</th>
                    @endforeach
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $tempInner = 0;
                @endphp
                @foreach ($scenario as $row)
                    <tr>
                        <td>{{ $row['laboratorium'] }}</td>
                        @php
                            $temp = 0;
                        @endphp
                        @for ($i = 0; $i < count($totalDays); $i++)
                            @if (isset($row['jam'][$i]))
                                <td>{{ $row['jam'][$i] }}</td>
                                @php
                                    $temp += $row['jam'][$i];
                                @endphp
                            @else
                                <td>0</td>
                            @endif
                        @endfor
                        <td>{{ $temp }}</td>
                        @php
                            $tempInner += $temp;
                        @endphp
                    </tr>
                @endforeach
                <tr>
                    <th>Total</th>
                    @foreach ($total_baris as $item)
                        <td>{{ $item }}</td>
                    @endforeach
                    <td>{{ $tempInner }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
