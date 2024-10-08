<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tibracomm.</title>
    @vite('resources/css/app.css')
</head>

@php
    $gridItems = [
        [
            'title' => 'Grid 1',
            'animation' => 'grid-to-right',
            'color' => 'bg-cyan-700',
            'textColor' => 'text-white',
            'colSpan' => 2,
            'rowSpan' => 1,
            'colStart' => 1,
            'rowStart' => 1,
            'isSlider' => true,
            'images' => [
                'https://placehold.co/400x400?text=Slide+1',
                'https://placehold.co/400x400?text=Slide+2',
                'https://placehold.co/400x400?text=Slide+3',
                'https://placehold.co/400x400?text=Slide+4',
                'https://placehold.co/400x400?text=Slide+5',
            ],
            'description' =>
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.',
        ],
        // [
        //     'title' => 'Grid 2',
        //     'animation' => 'grid-to-bottom',
        //     'color' => 'bg-yellow-600',
        //     'textColor' => 'text-white',
        //     'colSpan' => 1,
        //     'rowSpan' => 1,
        //     'colStart' => 2,
        //     'rowStart' => 1,
        //     'isSlider' => false,
        //     'images' => [
        //         'https://placehold.co/400x400?text=Slide+1',
        //         'https://placehold.co/400x400?text=Slide+2',
        //         'https://placehold.co/400x400?text=Slide+3',
        //         'https://placehold.co/400x400?text=Slide+4',
        //         'https://placehold.co/400x400?text=Slide+5',
        //     ],
        //     'description' =>
        //         'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.',
        // ],
        [
            'title' => 'Grid 3',
            'animation' => 'grid-to-bottom',
            'color' => 'bg-green-700',
            'textColor' => 'text-white',
            'colSpan' => 1,
            'rowSpan' => 1,
            'colStart' => 3,
            'rowStart' => 1,
            'isSlider' => false,
            'images' => [
                'https://placehold.co/400x400?text=Slide+1',
                'https://placehold.co/400x400?text=Slide+2',
                'https://placehold.co/400x400?text=Slide+3',
                'https://placehold.co/400x400?text=Slide+4',
                'https://placehold.co/400x400?text=Slide+5',
            ],
            'description' =>
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.',
        ],
        [
            'title' => 'Grid 4',
            'animation' => 'grid-to-right',
            'color' => 'bg-red-700',
            'textColor' => 'text-white',
            'colSpan' => 1,
            'rowSpan' => 1,
            'colStart' => 1,
            'rowStart' => 2,
            'isSlider' => false,
            'images' => [
                'https://placehold.co/400x400?text=Slide+1',
                'https://placehold.co/400x400?text=Slide+2',
                'https://placehold.co/400x400?text=Slide+3',
                'https://placehold.co/400x400?text=Slide+4',
                'https://placehold.co/400x400?text=Slide+5',
            ],
            'description' =>
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.',
        ],
        [
            'title' => 'Grid 5',
            'animation' => 'grid-to-left',
            'color' => 'bg-purple-700',
            'textColor' => 'text-white',
            'colSpan' => 1,
            'rowSpan' => 1,
            'colStart' => 2,
            'rowStart' => 2,
            'isSlider' => false,
            'images' => [
                'https://placehold.co/400x400?text=Slide+1',
                'https://placehold.co/400x400?text=Slide+2',
                'https://placehold.co/400x400?text=Slide+3',
                'https://placehold.co/400x400?text=Slide+4',
                'https://placehold.co/400x400?text=Slide+5',
            ],
            'description' =>
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.',
        ],
        [
            'title' => 'Grid 6',
            'animation' => 'grid-to-top',
            'color' => 'bg-slate-700',
            'textColor' => 'text-white',
            'colSpan' => 1,
            'rowSpan' => 1,
            'colStart' => 3,
            'rowStart' => 2,
            'isSlider' => false,
            'images' => [
                'https://placehold.co/400x400?text=Slide+1',
                'https://placehold.co/400x400?text=Slide+2',
                'https://placehold.co/400x400?text=Slide+3',
                'https://placehold.co/400x400?text=Slide+4',
                'https://placehold.co/400x400?text=Slide+5',
            ],
            'description' =>
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.',
        ],
    ];

    $colSpanClasses = [
        1 => 'col-span-1',
        2 => 'col-span-2',
        3 => 'col-span-3',
    ];
    $rowSpanClasses = [
        1 => 'row-span-1',
        2 => 'row-span-2',
    ];
    $colStartClasses = [
        1 => 'col-start-1',
        2 => 'col-start-2',
        3 => 'col-start-3',
    ];
    $rowStartClasses = [
        1 => 'row-start-1',
        2 => 'row-start-2',
    ];

@endphp

<body class="h-screen w-screen">
    <div class="grid grid-cols-3 h-full w-full cursor-default">
        @foreach ($gridItems as $grid)
            @php
                $sliderClass = '';
                switch ($grid['animation']) {
                    case 'grid-to-right':
                        $sliderClass = 'top-0 left-full w-0 h-full';
                        break;
                    case 'grid-to-left':
                        $sliderClass = 'top-0 right-full w-0 h-full';
                        break;
                    case 'grid-to-top':
                        $sliderClass = 'bottom-full left-0 w-full h-0';
                        break;
                    case 'grid-to-bottom':
                        $sliderClass = 'top-full left-0 w-full h-0';
                        break;
                }

                $gridOptionClass = '';
                $gridOptionClass .= $colSpanClasses[$grid['colSpan']] . ' ';
                $gridOptionClass .= $rowSpanClasses[$grid['rowSpan']] . ' ';
                $gridOptionClass .= $colStartClasses[$grid['colStart']] . ' ';
                $gridOptionClass .= $rowStartClasses[$grid['rowStart']] . ' ';
                $gridOptionClass .= $grid['color'] . ' ';
                $gridOptionClass .= $grid['textColor'] . ' ';
            @endphp

            <div class="relative {{ $gridOptionClass }}">
                @if ($grid['isSlider'])
                    <div class="slider relative bg-white w-full h-full">
                        @foreach ($grid['images'] as $image)
                            <img src="{{ $image }}" alt="slider image"
                                class="absolute top-0 left-0 h-full w-full object-cover opacity-0" style="transition: all .5s linear">
                        @endforeach
                    </div>
                @else
                    <div class="{{ $grid['animation'] }} group p-20 h-full flex items-center">
                        <div class="w-full h-full relative">
                            <div class="text-3xl font-bold absolute top-1/2 -translate-y-1/2  overflow-hidden max-h-[40px] group-hover:max-h-full"
                                style="transition: all 1s linear; transition-delay:1s">
                                {{ $grid['title'] }}
                                <p class="opacity-0 font-normal text-base group-hover:opacity-100"
                                    style="transition: all 1s linear; transition-delay:1s">
                                    {{ $grid['description'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="slider absolute bg-white z-10 {{ $sliderClass }}" style="transition: all .5s linear">
                        @foreach ($grid['images'] as $image)
                            <img src="{{ $image }}" alt="slider image"
                                class="absolute top-0 left-0 h-full w-full object-cover opacity-0" style="transition: all .5s linear">
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <script>
        const SLIDER_INTERVAL = 2000;

        const slideXMouseEnter = (e) => {
            const elem = e.target;
            const slider = elem.parentElement.querySelector('.slider');
            slider.classList.replace("w-0", "w-full");
        }

        const slideXMouseLeave = (e) => {
            const elem = e.target;
            const slider = elem.parentElement.querySelector('.slider');
            slider.classList.replace("w-full", "w-0");

        }

        const slideYMouseEnter = (e) => {
            const elem = e.target;
            const slider = elem.parentElement.querySelector('.slider');
            slider.classList.replace("h-0", "h-full");
        }

        const slideYMouseLeave = (e) => {
            const elem = e.target;
            const slider = elem.parentElement.querySelector('.slider');
            slider.classList.replace("h-full", "h-0");
        }

        window.addEventListener('DOMContentLoaded', () => {
            const xElems = document.querySelectorAll('.grid-to-right, .grid-to-left');
            const yElems = document.querySelectorAll('.grid-to-top, .grid-to-bottom');
            const sliders = document.querySelectorAll('.slider');

            xElems.forEach(elem => {
                elem.addEventListener('mouseenter', slideXMouseEnter);
                elem.addEventListener('mouseleave', slideXMouseLeave);
            });

            yElems.forEach(elem => {
                elem.addEventListener('mouseenter', slideYMouseEnter);
                elem.addEventListener('mouseleave', slideYMouseLeave);
            });

            sliders.forEach((slider, index) => {
                let currentIndex = 0;
                const images = slider.querySelectorAll('img');
                const count = images.length;

                if (count === 0) return;
                
                // init slider
                slider.firstElementChild.classList.remove('opacity-0');
                
                setInterval(() => {
                    const nextIndex = currentIndex === count - 1 ? 0 : currentIndex + 1;
                    images[currentIndex].classList.add('opacity-0');
                    images[nextIndex].classList.remove('opacity-0');
                    currentIndex = nextIndex;
                }, SLIDER_INTERVAL);

            });
        });
    </script>
</body>

</html>
