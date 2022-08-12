@if($customers)

    <h3> {{$filter_title ?? ''}}</h3>

    @foreach ($customers as $customer)

        <div class="list-group-item white-text rounded-pill" style=" border-radius: 0; height: 80px">
            <div>
                <b>{{ $customer->name }} </b> /

                {{ $customer->uniqueCode }}

                @if($customer->address)
                    /
                @endif
                {{ $customer->address }}

                @if($customer->city)
                    /
                @endif
                {{ $customer->city }}

                @if($customer->zipCode)
                    /
                @endif
                {{ $customer->zipCode }}

                @if($customer->country)
                    /
                @endif
                {{ $customer->country }}
            </div>
            <div>

                {{ $customer->cif }}

                @if($customer->ocr)
                    /
                @endif
                {{ $customer->ocr }}

                @if($customer->iban)
                    /
                @endif
                {{ $customer->iban }}

                @if($customer->swift)
                    /
                @endif
                {{ $customer->swift }}

                @if($customer->bank)
                    /
                @endif
                {{ $customer->bank }}

            </div>

            <div>
                {{$customer->contact}}

                @if($customer->phone)
                    /
                @endif

                {{ $customer->phone }}

                @if($customer->phone2)
                    /
                @endif
                {{ $customer->phone2 }}

                @if($customer->type)
                    /
                @endif
                {{ $customer->type }}

                @if($customer->email)
                    /
                @endif
                {{ $customer->email }}

                @if($customer->www)
                    /
                @endif
                {{ $customer->www }}

                @if($customer->note)
                    /
                @endif
                {{ $customer->note }}

            </div>
        </div>
    @endforeach
@endif
