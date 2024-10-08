<x-mazer-sidebar :href="route('dashboard')" logo="asset('static/images/logo/logo.svg')">
    <x-mazer-sidebar-item icon="bi bi-grid-fill" route="dashboard" :link="route('dashboard')" name="Dashboard" />
    <x-mazer-sidebar-item icon="bi bi-fingerprint" route="device.index" :link="route('device.index')" name="Device" />
    <x-mazer-sidebar-item icon="bi bi-person-lines-fill" name="Pengaturan">
        <x-mazer-sidebar-subitem :link="route('pengaturan.index')" route="pengaturan.index" name="Sekolah" :active="false" />
        <x-mazer-sidebar-subitem :link="route('jamkerja.index')" route="jemkerja.index" name="Jam Kerja" :active="false" />
    </x-mazer-sidebar-item>

    <x-mazer-sidebar-item icon="icon-mid bi bi-person-circle" name="Account">
        <x-mazer-sidebar-subitem :link="route('profile.edit')" route="profile.edit" name="Profile" :active="false"/>
        <x-mazer-sidebar-subitem :link="route('profile.security')" route="profile.security" name="Security" :active="false"/>
    </x-mazer-sidebar-item>
    <x-mazer-sidebar-menu name="Settings" />
    <x-mazer-sidebar-button icon="bi bi-grid-fill" :link="route('logout')" name="Log Out" />
</x-mazer-sidebar>
