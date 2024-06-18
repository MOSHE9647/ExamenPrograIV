import { Component, Input } from '@angular/core';

@Component({
	standalone: true,
	selector: 'app-notification',
	template: `
		<div id="notification-container">
			<div id="toastNotification" class="toast">
				<div class="toast-content">
					<i class="fas fa-solid las {{ getIcon(type) }} check {{ type }}"></i>
					<div class="message">
						<span class="text text-1">{{ title }}</span>
						<span class="text text-2">{{ message }}</span>
					</div>
				</div>
				<i class="fa-solid las la-times close"></i>
				<div class="progress {{ type }}"></div>
			</div>
		</div>
	`,
	// templateUrl: './notification.component.html',
	styleUrls: ['./notification.component.css']
})
export class NotificationComponent {
	@Input() title: string = '';
	@Input() message: string = '';
	@Input() type: string = '';
	@Input() autoHide = true;
	@Input() hideDelay = 5000; // milliseconds

	getIcon(type: string) {
		var icon = '';
		switch (type) {
			case 'success':
				icon = 'la-check';
				break;
			case 'error':
				icon = 'la-times';
				break
			default:
				icon = 'la-exclamation-triangle';
				break;
		}
		return icon;
	}

	showNotification() {
		const toast = document.getElementById('toastNotification')!;
		const closeIcon = document.querySelector('.close')!;
		const progress = document.querySelector('.progress')!;

		toast.classList.add('active');
		progress.classList.add('active');

		setTimeout(() => {
			toast.classList.remove('active');
		}, 5000);

		setTimeout(() => {
			progress.classList.remove('active');
		}, 5300);

		closeIcon.addEventListener('click', () => {
			toast.classList.remove('active');

			setTimeout(() => {
				progress.classList.remove('active');
			}, 300);
		});
	}

	ngOnInit() {
		this.showNotification();
	}
}