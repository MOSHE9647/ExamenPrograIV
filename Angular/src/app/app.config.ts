import { ApplicationConfig, provideZoneChangeDetection } from '@angular/core';
import { provideRouter } from '@angular/router';

import { routes } from './app.routes';
import { provideClientHydration } from '@angular/platform-browser';
import { provideAnimations } from '@angular/platform-browser/animations';
import { provideToastr } from 'ngx-toastr';
import { provideHttpClient, withFetch } from '@angular/common/http';

export const appConfig: ApplicationConfig = {
	providers: [
		// Default Providers
		provideZoneChangeDetection({ eventCoalescing: true }),
		provideRouter(routes),
		provideClientHydration(),
		provideHttpClient(withFetch()),

		//Extra Providers:
		provideAnimations(),
		provideToastr({
			timeOut: 5000, // Auto-hide after 5 seconds (like your JS code)
			closeButton: true, // Add close button
			progressBar: true, // Add progress bar
		})
	]
};
