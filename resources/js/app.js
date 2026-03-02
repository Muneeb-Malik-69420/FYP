// import './bootstrap';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

// If you have any Alpine plugins, initialize them here
//  import './bootstrap';

// Import Alpine.js correctly for the TALL stack
import { Alpine, Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';

// This is the magic line that makes x-data work!
window.Alpine = Alpine;

Alpine.start();
Alpine.start();