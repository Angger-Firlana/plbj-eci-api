<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# API Documentation

This document provides detailed information about the API endpoints.

---

## Authentication

### `POST /api/auth/login`

Authenticates a user and returns a token.

**Request Body:**

```json
{
  "input": "test@example.com",
  "password": "password"
}
```

| Field      | Type   | Validation                  | Description                             |
|------------|--------|-----------------------------|-----------------------------------------|
| `input`    | string | required, string, max:255   | User's email or username.                |
| `password` | string | required, string, min:8     | User's password.                        |


**Responses:**

*   **200 OK (Success)**
    ```json
    {
      "success": true,
      "data": [
        {
          "code": 200,
          "user": {
            "id": 1,
            "name": "Test User",
            "email": "test@example.com",
            "is_active": 1,
            "pin": "123456",
            "profile_photo": null,
            "role_id": 1
          },
          "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
        }
      ]
    }
    ```

*   **401 Unauthorized (Invalid Credentials)**
    ```json
    {
      "success": false,
      "message": "Login failed",
      "error": "Invalid credentials"
    }
    ```

*   **422 Unprocessable Entity (Validation Error)**
    ```json
    {
      "message": "The given data was invalid.",
      "errors": {
        "input": [
          "Email atau Nomor HP wajib diisi"
        ]
      }
    }
    ```

### `POST /api/auth/register`

Registers a new user.

**Request Body (form-data):**

| Field                   | Type   | Validation                                          |
|-------------------------|--------|-----------------------------------------------------|
| `name`                  | string | required, string, max:255                           |
| `email`                 | string | required, email, max:255, unique:users              |
| `password`              | string | required, min:8, confirmed                          |
| `password_confirmation` | string | required, min:8                                     |
| `pin`                   | string | required, min:6, max:6                              |
| `is_active`             | bool   | required, boolean                                   |
| `role_id`               | int    | required, exists:roles,id                           |
| `profile_photo`         | file   | nullable, image, mimes:jpeg,png,jpg,gif,svg, max:2048|


**Responses:**

*   **201 Created (Success)**
    ```json
    {
      "success": true,
      "data": {
        "user": {
          "name": "New User",
          "email": "new@example.com",
          "is_active": "1",
          "pin": "123456",
          "role_id": "2",
          "profile_photo_path": "profile_photos/xxxxxxxx.jpg",
          "updated_at": "2026-01-07T12:00:00.000000Z",
          "created_at": "2026-01-07T12:00:00.000000Z",
          "id": 10
        }
      }
    }
    ```

*   **422 Unprocessable Entity (Validation Error)**
    ```json
    {
      "message": "The given data was invalid.",
      "errors": {
        "password": [
          "The password confirmation does not match."
        ]
      }
    }
    ```

---

## Departments

### `GET /api/departments`
Retrieves a paginated list of departments.

**Query Parameters:**

| Field   | Type    | Default | Description                  |
|---------|---------|---------|------------------------------|
| `page`  | integer | 1       | The page number to retrieve. |
| `limit` | integer | 10      | The number of items per page.|

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "current_page": 1,
      "data": [
          {
              "id": 1,
              "name": "IT",
              "code": "D-IT",
              "description": "Information Technology",
              "created_at": "2026-01-07T12:00:00.000000Z",
              "updated_at": "2026-01-07T12:00:00.000000Z"
          }
      ],
      "first_page_url": "/api/departments?page=1",
      "from": 1,
      "next_page_url": "/api/departments?page=2",
      "path": "/api/departments",
      "per_page": 10,
      "prev_page_url": null,
      "to": 10
  }
  ```

### `GET /api/departments/{id}`
Retrieves a specific department by its ID.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Department found",
      "code": 200,
      "data": {
          "id": 1,
          "name": "IT",
          "code": "D-IT",
          "description": "Information Technology",
          "created_at": "2026-01-07T12:00:00.000000Z",
          "updated_at": "2026-01-07T12:00:00.000000Z"
      }
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Department not found",
      "code": 404
  }
  ```

### `POST /api/departments`
Creates a new department.

**Request Body:**
```json
{
    "name": "Human Resources",
    "code": "D-HR",
    "description": "Handles all employee-related matters"
}
```

| Field         | Type   | Validation        |
|---------------|--------|-------------------|
| `name`        | string | required, string  |
| `code`        | string | required, string  |
| `description` | string | required, string  |


**Responses:**

* **201 Created (Success)**
  ```json
  {
      "message": "Department created successfully",
      "code": 201,
      "data": {
          "name": "Human Resources",
          "code": "D-HR",
          "description": "Handles all employee-related matters",
          "updated_at": "2026-01-07T12:00:00.000000Z",
          "created_at": "2026-01-07T12:00:00.000000Z",
          "id": 2
      }
  }
  ```
* **422 Unprocessable Entity (Validation Error)**
  ```json
  {
    "message": "The given data was invalid.",
    "errors": {
        "name": ["The name field is required."]
    }
  }
  ```

### `PUT /api/departments/{id}`
Updates an existing department.

**Request Body:**
```json
{
    "name": "Human Resources Updated",
    "description": "Updated description"
}
```
| Field         | Type   | Validation        |
|---------------|--------|-------------------|
| `name`        | string | sometimes, string |
| `code`        | string | sometimes, string |
| `description` | string | sometimes, string |


**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Department updated successfully",
      "code": 200,
      "data": {
          "id": 2,
          "name": "Human Resources Updated",
          "code": "D-HR",
          "description": "Updated description",
          "created_at": "2026-01-07T12:00:00.000000Z",
          "updated_at": "2026-01-07T12:01:00.000000Z"
      }
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Department not found",
      "code": 404
  }
  ```

### `DELETE /api/departments/{id}`
Deletes a department.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Department deleted successfully",
      "code": 200
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Department not found",
      "code": 404
  }
  ```
---

## Stores

### `GET /api/stores`
Retrieves a paginated list of stores.

**Query Parameters:**
| Field   | Type    | Default | Description                  |
|---------|---------|---------|------------------------------|
| `page`  | integer | 1       | The page number to retrieve. |
| `limit` | integer | 10      | The number of items per page.|

### `POST /api/stores`
Creates a new store.

**Request Body:**
| Field        | Type    | Validation              |
|--------------|---------|-------------------------|
| `store_code` | string  | required, string        |
| `name`       | string  | required, string        |
| `address`    | string  | required, string        |
| `city`       | string  | required, string        |
| `phone`      | string  | required, string        |
| `email`      | string  | required, email         |
| `is_active`  | integer | required, integer       |

**Responses:**
* **201 Created (Success)**
  ```json
  {
      "data": { ...store object... },
      "message": "Store created successfully",
      "code": 201
  }
  ```

### `PUT /api/stores/{id}`
Updates a store.

**Request Body:**
| Field        | Type    | Validation              |
|--------------|---------|-------------------------|
| `store_code` | string  | sometimes, string        |
| `name`       | string  | sometimes, string        |
| `address`    | string  | sometimes, string        |
| `city`       | string  | sometimes, string        |
| `phone`      | string  | sometimes, string        |
| `email`      | string  | sometimes, email         |
| `is_active`  | integer | sometimes, integer       |

---

## LPBJ

### `POST /api/lpbjs`
Creates a new LPBJ with associated items.

**Request Body:**
*Note: Validation is handled in the service layer, not via a FormRequest.*
```json
{
    "title": "New Equipment Request",
    "request_by": 1,
    "lpbj_number": 12345,
    "department_id": 1,
    "request_date": "2026-01-07",
    "store_id": 1,
    "items": [
        {
            "name": "Laptop",
            "quantity": 2,
            "media": "Unit",
            "article": "LP-01",
            "store_id": 1,
            "general_ledger": "GL-100",
            "cost_center": "CC-200",
            "order": "ORD-300",
            "information": "For new developers"
        }
    ]
}
```

### `PUT /api/lpbjs/{id}`
Updates an LPBJ and its items.

**Request Body:**
Fields are optional. To update items, include the `items` array. To update an existing item, include its `id`.
```json
{
    "title": "Updated Equipment Request",
    "items": [
        {
            "id": 1,
            "name": "High-Performance Laptop",
            "quantity": 3
        }
    ]
}
```

---

## Jobs

### `GET /api/jobs`
Retrieves a paginated list of jobs.

### `POST /api/jobs`
Creates a new job.

**Request Body:**
| Field          | Type    | Validation                         |
|----------------|---------|------------------------------------|
| `department_id`| integer | nullable, exists:departments,id    |
| `job_level_id` | integer | required, exists:job_levels,id      |
| `name`         | string  | required, string                   |
| `head_count`   | integer | required, integer                  |

### `PUT /api/jobs/{id}`
Updates a job.

**Request Body:**
| Field          | Type    | Validation                         |
|----------------|---------|------------------------------------|
| `department_id`| integer | sometimes, exists:departments,id    |
| `job_level_id` | integer | sometimes, exists:job_levels,id      |
| `name`         | string  | sometimes, string                   |
| `head_count`   | integer | sometimes, integer                  |

---

## Positions

### `POST /api/positions`
Assigns a job to a user, creating a position.

**Request Body:**
| Field        | Type    | Validation                   |
|--------------|---------|------------------------------|
| `eci_job_id` | integer | required, exists:eci_jobs,id |
| `user_id`    | integer | required, exists:users,id    |

### `PUT /api/positions/{id}`
Updates a position.

**Request Body:**
| Field        | Type    | Validation                   |
|--------------|---------|------------------------------|
| `eci_job_id` | integer | sometimes, exists:eci_jobs,id |
| `user_id`    | integer | sometimes, exists:users,id    |

---

## Vendors

### `POST /api/vendors`
Creates a new vendor.

**Request Body:**
| Field            | Type   | Validation        |
|------------------|--------|-------------------|
| `name`           | string | required, string  |
| `address`        | string | required, string  |
| `phone`          | string | required, string  |
| `email`          | string | required, email   |
| `to_vendor`      | string | required, string  |
| `contact_person` | string | required, string  |

### `PUT /api/vendors/{id}`
Updates a vendor.

**Request Body:**
| Field            | Type   | Validation        |
|------------------|--------|-------------------|
| `name`           | string | sometimes, string |
| `address`        | string | sometimes, string |
| `phone`          | string | sometimes, string |
| `email`          | string | sometimes, email  |
| `to_vendor`      | string | sometimes, string |
| `contact_person` | string | sometimes, string |

//test by TrisGan44
