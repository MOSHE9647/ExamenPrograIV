import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';
import { Environment } from "../../../environments/environment";

interface FrameworkLink {
	name: string;
	url: string;
}

@Component({
	selector: 'app-home',
	standalone: true,
	imports: [CommonModule, RouterLink],
	template: `
		<div class="container mt-5 w-50">
			<h1 class="text-center">Enlaces a los Frameworks</h1>
			<ul class="list-group">
				<li *ngFor="let link of frameworks" class="list-group-item list-group-item-action list-group-item-light">
					@if (isExternalLink(link.url)) {
						<a [href]="link.url">{{ link.name }}</a>
					}
					@else if (!isExternalLink(link.url)) {
						<a [routerLink]="link.url">{{ link.name }}</a>
					}
				</li>
			</ul>
		</div>
	`,
	styles: []
})
export class HomeComponent {

	frameworks: FrameworkLink[] = [
		{ name: 'React', url: Environment.apiUrl + Environment.reactPort + '/react' },
		{ name: 'Angular', url: '/angular' },
		{ name: 'Vue', url: 'https://vuejs.org' },
		{ name: 'Laravel', url: 'https://laravel.com' }
	];

	isExternalLink(url: string): boolean {
		return url.startsWith('http://') || url.startsWith('https://');
	}

}