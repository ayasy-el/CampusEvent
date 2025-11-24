<x-filament-panels::page>
    <div class="grid gap-4">
        <x-filament-widgets::widgets
            :widgets="$this->getWidgets()"
            :columns="$this->getColumns()" />
    </div>
</x-filament-panels::page>