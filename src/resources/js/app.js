Alpine.store('darkMode', {
    dark: localStorage.getItem('darkMode') === 'true',

    toggle() {
        this.dark = ! this.dark;
        localStorage.setItem('darkMode', this.dark);
        this.apply();
    },

    apply() {
        if (this.dark) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    }
});

document.addEventListener('livewire:navigated', () => {
    const isDark = localStorage.getItem('darkMode') === 'true';
    if (isDark) {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
});