import requests
from django.http import JsonResponse
from rest_framework.views import APIView

# URL de las API's de SpringBoot
baseURL = 'http://25.7.147.209:8080/api/v1/usuarios'

class UsuarioListAPI(APIView):
    def get(self, request):
        # Check for query parameters to determine which API to call
        id = request.query_params.get('id')
        if id:
            url = baseURL + '/get'
            try:
                response = requests.get(url, params={'id': id})
                response.raise_for_status()  # Lanza un error si la respuesta HTTP no es 200
                data = response.json()
                return JsonResponse(data, safe=False)
            except requests.exceptions.RequestException as e:
                return JsonResponse({"error": str(e)}, status=500)
        elif 'active' in request.query_params:
            url = baseURL + '/getActive'
            try:
                response = requests.get(url)
                response.raise_for_status()  # Lanza un error si la respuesta HTTP no es 200
                data = response.json()
                return JsonResponse(data, safe=False)
            except requests.exceptions.RequestException as e:
                return JsonResponse({"error": str(e)}, status=500)
        elif 'inactive' in request.query_params:
            url = baseURL + '/getInactive'
            try:
                response = requests.get(url)
                response.raise_for_status()  # Lanza un error si la respuesta HTTP no es 200
                data = response.json()
                return JsonResponse(data, safe=False)
            except requests.exceptions.RequestException as e:
                return JsonResponse({"error": str(e)}, status=500)
        else:
            url = baseURL + '/getAll'
            try:
                response = requests.get(url)
                response.raise_for_status()  # Lanza un error si la respuesta HTTP no es 200
                data = response.json()
                return JsonResponse(data, safe=False)
            except requests.exceptions.RequestException as e:
                return JsonResponse({"error": str(e)}, status=500)

class UsuarioCreateAPI(APIView):
    def post(self, request):
        url = baseURL + '/create'
        try:
            response = requests.post(url, json=request.data)
            response.raise_for_status()  # Lanza un error si la respuesta HTTP no es 200
            data = response.json()
            return JsonResponse(data, safe=False)
        except requests.exceptions.RequestException as e:
            return JsonResponse({"error": str(e)}, status=500)

class UsuarioUpdateAPI(APIView):
    def put(self, request):
        url = baseURL + '/update'
        try:
            response = requests.put(url, json=request.data)
            response.raise_for_status()  # Lanza un error si la respuesta HTTP no es 200
            data = response.json()
            return JsonResponse(data, safe=False)
        except requests.exceptions.RequestException as e:
            return JsonResponse({"error": str(e)}, status=500)

class UsuarioDeleteAPI(APIView):
    def delete(self, request):
        id = request.query_params.get('id')
        if not id:
            return JsonResponse({"error": "ID is required"}, status=400)
        
        if 'logical' in request.query_params:
            url = baseURL + '/delete/logical'
            try:
                response = requests.delete(url, params={'id': id})
                response.raise_for_status()  # Lanza un error si la respuesta HTTP no es 200
                data = response.json()
                return JsonResponse(data, safe=False)
            except requests.exceptions.RequestException as e:
                return JsonResponse({"error": str(e)}, status=500)
        else:
            url = baseURL + '/delete/physical'
            try:
                response = requests.delete(url, params={'id': id})
                response.raise_for_status()  # Lanza un error si la respuesta HTTP no es 200
                data = response.json()
                return JsonResponse(data, safe=False)
            except requests.exceptions.RequestException as e:
                return JsonResponse({"error": str(e)}, status=500)
