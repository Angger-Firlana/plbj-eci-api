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

### `GET /api/user`

Retrieves the authenticated user's information.

**Authentication:**

Requires a valid Sanctum token.

**Responses:**

*   **200 OK (Success)**
    ```json
    {
        "id": 1,
        "name": "Test User",
        "email": "test@example.com",
        "email_verified_at": null,
        "created_at": "2026-01-07T12:00:00.000000Z",
        "updated_at": "2026-01-07T12:00:00.000000Z",
        "is_active": 1,
        "pin": "123456",
        "profile_photo": null,
        "role_id": 1
    }
    ```

*   **401 Unauthorized**
    ```json
    {
        "message": "Unauthenticated."
    }
    ```

---

## Departments

### `GET /api/departments`
Retrieves a paginated list of departments.

**Query Parameters:**

| Field   | Type    | Default | Description                  |
|---------|---------|------------------------------|
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

### `GET /api/stores/{id}`
Retrieves a specific store by its ID.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Store found",
      "code": 200,
      "data": {
          "id": 1,
          "store_code": "S-001",
          "name": "Main Store",
          "address": "123 Main St",
          "city": "Anytown",
          "phone": "123-456-7890",
          "email": "main@store.com",
          "is_active": 1,
          "created_at": "2026-01-07T12:00:00.000000Z",
          "updated_at": "2026-01-07T12:00:00.000000Z"
      }
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Store not found",
      "code": 404
  }
  ```

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
      "data": {
          "store_code": "S-002",
          "name": "New Store",
          "address": "456 Oak Ave",
          "city": "Othertown",
          "phone": "987-654-3210",
          "email": "new@store.com",
          "is_active": "1",
          "updated_at": "2026-01-07T12:00:00.000000Z",
          "created_at": "2026-01-07T12:00:00.000000Z",
          "id": 2
      },
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

### `DELETE /api/stores/{id}`
Deletes a store.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Store deleted successfully",
      "code": 200
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Store not found",
      "code": 404
  }
  ```

---

## LPBJ

### `GET /api/lpbjs`
Retrieves a paginated list of LPBJs.

**Query Parameters:**
| Field   | Type    | Default | Description                  |
|---------|---------|---------|------------------------------|
| `page`  | integer | 1       | The page number to retrieve. |
| `limit` | integer | 10      | The number of items per page.|

### `GET /api/lpbjs/{id}`
Retrieves a specific LPBJ by its ID.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "LPBJ found",
      "code": 200,
      "data": {
          "id": 1,
          "title": "Equipment Request",
          "request_by": 1,
          "lpbj_number": 12345,
          "department_id": 1,
          "request_date": "2026-01-07",
          "store_id": 1,
          "created_at": "2026-01-07T12:00:00.000000Z",
          "updated_at": "2026-01-07T12:00:00.000000Z",
          "items": [
              {
                  "id": 1,
                  "lpbj_id": 1,
                  "name": "Laptop",
                  "quantity": 2,
                  "media": "Unit",
                  "article": "LP-01",
                  "store_id": 1,
                  "general_ledger": "GL-100",
                  "cost_center": "CC-200",
                  "order": "ORD-300",
                  "information": "For new developers",
                  "item_photo": "item_photos/xxxxxxxx.jpg"
              }
          ]
      }
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "LPBJ not found",
      "code": 404
  }
  ```

### `POST /api/lpbjs`
Creates a new LPBJ with associated items.

**Request Body:**
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
            "information": "For new developers",
            "item_photo": "(file)"
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

### `DELETE /api/lpbjs/{id}`
Deletes a LPBJ.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "LPBJ deleted successfully",
      "code": 200
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "LPBJ not found",
      "code": 404
  }
  ```

---

## Jobs

### `GET /api/jobs`
Retrieves a paginated list of jobs.

### `GET /api/jobs/{id}`
Retrieves a specific job by its ID.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Job found",
      "code": 200,
      "data": {
          "id": 1,
          "department_id": 1,
          "job_level_id": 2,
          "name": "Senior Developer",
          "head_count": 5,
          "created_at": "2026-01-07T12:00:00.000000Z",
          "updated_at": "2026-01-07T12:00:00.000000Z"
      }
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Job not found",
      "code": 404
  }
  ```

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

### `DELETE /api/jobs/{id}`
Deletes a job.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Job deleted successfully",
      "code": 200
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Job not found",
      "code": 404
  }
  ```

---

## Positions

### `GET /api/positions`
Retrieves a paginated list of positions.

### `GET /api/positions/{id}`
Retrieves a specific position by its ID.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Position found",
      "code": 200,
      "data": {
          "id": 1,
          "eci_job_id": 1,
          "user_id": 1,
          "created_at": "2026-01-07T12:00:00.000000Z",
          "updated_at": "2026-01-07T12:00:00.000000Z"
      }
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Position not found",
      "code": 404
  }
  ```

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

### `DELETE /api/positions/{id}`
Deletes a position.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Position deleted successfully",
      "code": 200
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Position not found",
      "code": 404
  }
  ```

---

## Vendors

### `GET /api/vendors`
Retrieves a paginated list of vendors.

### `GET /api/vendors/{id}`
Retrieves a specific vendor by its ID.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Vendor found",
      "code": 200,
      "data": {
          "id": 1,
          "name": "Supplier A",
          "address": "456 Supplier Ave",
          "phone": "321-654-9870",
          "email": "supplier.a@example.com",
          "to_vendor": "Attention: Sales",
          "contact_person": "John Doe",
          "created_at": "2026-01-07T12:00:00.000000Z",
          "updated_at": "2026-01-07T12:00:00.000000Z"
      }
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Vendor not found",
      "code": 404
  }
  ```

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

### `DELETE /api/vendors/{id}`
Deletes a vendor.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Vendor deleted successfully",
      "code": 200
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Vendor not found",
      "code": 404
  }
  ```

---
## Quotations

### `GET /api/quotations`
Retrieves a paginated list of quotations.

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
              "lpbj_id": 1,
              "quotation_number": "Q-123",
              "quotation_date": "2026-01-07",
              "created_at": "2026-01-07T12:00:00.000000Z",
              "updated_at": "2026-01-07T12:00:00.000000Z"
          }
      ],
      "first_page_url": "/api/quotations?page=1",
      "from": 1,
      "next_page_url": "/api/quotations?page=2",
      "path": "/api/quotations",
      "per_page": 10,
      "prev_page_url": null,
      "to": 10
  }
  ```

### `GET /api/quotations/{id}`
Retrieves a specific quotation by its ID.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Quotation found",
      "code": 200,
      "data": {
          "id": 1,
          "lpbj_id": 1,
          "quotation_number": "Q-123"
      }
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Quotation not found",
      "code": 404
  }
  ```

### `POST /api/quotations`
Creates a new quotation.

**Request Body:**
```json
{
    "lpbj_id": 1,
    "quotation_number": "Q-123",
    "quotation_date": "2026-01-07",
    "pr_no": "PR-001",
    "description": "Quotation for new equipment",
    "frenco": "Franco",
    "pkp": "PKP",
    "quotation_details": [
        {
            "item_id": 1,
            "quantity": 2,
            "price": 1500,
            "total_price": 3000,
            "remarks": "High-performance laptops"
        }
    ],
    "approvals": [
        {
            "approver_id": 2,
            "status": "pending"
        }
    ]
}
```

| Field                       | Type    | Validation                |
|-----------------------------|---------|---------------------------|
| `lpbj_id`                   | integer | required, exists:lpbjs,id |
| `quotation_number`          | string  | required, string          |
| `quotation_date`            | date    | required, date            |
| `pr_no`                     | string  | nullable, string          |
| `description`               | string  | nullable, string          |
| `frenco`                    | string  | nullable, string          |
| `pkp`                       | string  | nullable, string          |
| `quotation_details`         | array   | nullable, array           |
| `quotation_details.*.item_id` | integer | required, exists:lpbj_items,id |
| `quotation_details.*.quantity`| numeric | required, numeric         |
| `quotation_details.*.price`   | numeric | required, numeric         |
| `quotation_details.*.total_price`| numeric | required, numeric         |
| `quotation_details.*.remarks` | string  | sometimes, string         |
| `approvals`                 | array   | nullable, array           |
| `approvals.*.approver_id`   | integer | required, exists:users,id |
| `approvals.*.status`        | string  | required, string          |
| `approvals.*.approved_at`   | date    | nullable, date            |

**Responses:**

* **201 Created (Success)**
  ```json
  {
      "message": "Quotation created successfully",
      "code": 201,
      "data": {}
  }
  ```
* **422 Unprocessable Entity (Validation Error)**
  ```json
  {
    "message": "The given data was invalid.",
    "errors": {
        "quotation_number": ["The quotation number field is required."]
    }
  }
  ```

### `PUT /api/quotations/{id}`
Updates an existing quotation.

**Request Body:**
All fields are optional (`sometimes`).
```json
{
    "quotation_number": "Q-123-updated",
    "description": "Updated quotation description"
}
```

| Field                       | Type    | Validation                |
|-----------------------------|---------|---------------------------|
| `lpbj_id`                   | integer | sometimes, exists:lpbjs,id |
| `quotation_number`          | string  | sometimes, string          |
| `quotation_date`            | date    | sometimes, date            |


**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Quotation updated successfully",
      "code": 200,
      "data": {}
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Quotation not found",
      "code": 404
  }
  ```

### `DELETE /api/quotations/{id}`
Deletes a quotation.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Quotation deleted successfully",
      "code": 200
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Quotation not found",
      "code": 404
  }
  ```
---

## Purchased Orders

### `GET /api/purchased-orders`
Retrieves a paginated list of purchased orders.

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
              "quotation_id": 1,
              "vendor_id": 1,
              "purchased_order_number": "PO-2026-001",
              "purchased_order_date": "2026-01-07",
              "delivery_date": "2026-01-14",
              "status": "pending",
              "notes": "Urgent order",
              "created_at": "2026-01-07T12:00:00.000000Z",
              "updated_at": "2026-01-07T12:00:00.000000Z"
          }
      ],
      "first_page_url": "/api/purchased-orders?page=1",
      "from": 1,
      "next_page_url": "/api/purchased-orders?page=2",
      "path": "/api/purchased-orders",
      "per_page": 10,
      "prev_page_url": null,
      "to": 10
  }
  ```

### `GET /api/purchased-orders/{id}`
Retrieves a specific purchased order by its ID.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Purchased Order found",
      "code": 200,
      "data": {
          "id": 1,
          "quotation_id": 1,
          "vendor_id": 1,
          "purchased_order_number": "PO-2026-001",
          "purchased_order_date": "2026-01-07",
          "delivery_date": "2026-01-14",
          "status": "pending",
          "notes": "Urgent order",
          "created_at": "2026-01-07T12:00:00.000000Z",
          "updated_at": "2026-01-07T12:00:00.000000Z",
          "purchased_order_details": [
              {
                  "id": 1,
                  "purchased_order_id": 1,
                  "item_name": "Laptop",
                  "quantity": 2,
                  "price": 1500,
                  "total_price": 3000,
                  "remarks": "High-performance model"
              }
          ],
          "approvals": [
              {
                  "id": 1,
                  "document_type": "purchased_order",
                  "document_id": 1,
                  "approver_id": 2,
                  "status": "pending",
                  "approved_at": null
              }
          ]
      }
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Purchased Order not found",
      "code": 404
  }
  ```

### `POST /api/purchased-orders`
Creates a new purchased order.

**Request Body:**
```json
{
    "quotation_id": 1,
    "vendor_id": 1,
    "purchased_order_number": "PO-2026-001",
    "purchased_order_date": "2026-01-07",
    "delivery_date": "2026-01-14",
    "status": "pending",
    "notes": "Urgent order",
    "purchased_order_details": [
        {
            "item_name": "Laptop",
            "quantity": 2,
            "price": 1500,
            "total_price": 3000,
            "remarks": "High-performance model"
        }
    ],
    "approvals": [
        {
            "approver_id": 2,
            "status": "pending"
        }
    ]
}
```

| Field                                | Type    | Validation                                   |
|--------------------------------------|---------|----------------------------------------------|
| `quotation_id`                       | integer | required, exists:quotations,id               |
| `vendor_id`                          | integer | required, exists:vendors,id                  |
| `purchased_order_number`             | string  | required, string, max:255, unique:purchased_orders,purchased_order_number |
| `purchased_order_date`               | date    | required, date                               |
| `delivery_date`                      | date    | required, date, after_or_equal:purchased_order_date |
| `status`                             | string  | nullable, string, max:255 (e.g., pending, approved, rejected) |
| `notes`                              | string  | nullable, string                             |
| `purchased_order_details`            | array   | required, array                              |
| `purchased_order_details.*.item_name`| string  | required, string, max:255                    |
| `purchased_order_details.*.quantity` | numeric | required, numeric, min:1                     |
| `purchased_order_details.*.price`    | numeric | required, numeric, min:0                     |
| `purchased_order_details.*.total_price`| numeric | required, numeric, min:0                     |
| `purchased_order_details.*.remarks`  | string  | nullable, string                             |
| `approvals`                          | array   | nullable, array                              |
| `approvals.*.approver_id`            | integer | required, exists:users,id                    |
| `approvals.*.status`                 | string  | required, string                             |
| `approvals.*.approved_at`            | date    | nullable, date                               |

**Responses:**

* **201 Created (Success)**
  ```json
  {
      "message": "Purchased Order created successfully",
      "code": 201,
      "data": {
          // ... created purchased order object ...
      }
  }
  ```
* **422 Unprocessable Entity (Validation Error)**
  ```json
  {
    "message": "The given data was invalid.",
    "errors": {
        "purchased_order_number": ["The purchased order number field is required."]
    }
  }
  ```

### `PUT /api/purchased-orders/{id}`
Updates an existing purchased order.

**Request Body:**
All fields are optional (`sometimes`).
```json
{
    "status": "approved",
    "delivery_date": "2026-01-20"
}
```

| Field                                | Type    | Validation                                   |
|--------------------------------------|---------|----------------------------------------------|
| `quotation_id`                       | integer | sometimes, exists:quotations,id              |
| `vendor_id`                          | integer | sometimes, exists:vendors,id                 |
| `purchased_order_number`             | string  | sometimes, string, max:255, unique:purchased_orders,purchased_order_number,{id} |
| `purchased_order_date`               | date    | sometimes, date                              |
| `delivery_date`                      | date    | sometimes, date, after_or_equal:purchased_order_date |
| `status`                             | string  | sometimes, string, max:255                   |
| `notes`                              | string  | sometimes, string                            |
| `purchased_order_details`            | array   | sometimes, array                             |
| `purchased_order_details.*.item_name`| string  | sometimes, string, max:255                   |
| `purchased_order_details.*.quantity` | numeric | sometimes, numeric, min:1                    |
| `purchased_order_details.*.price`    | numeric | sometimes, numeric, min:0                    |
| `purchased_order_details.*.total_price`| numeric | sometimes, numeric, min:0                    |
| `purchased_order_details.*.remarks`  | string  | sometimes, string                            |
| `approvals`                          | array   | sometimes, array                             |
| `approvals.*.approver_id`            | integer | sometimes, exists:users,id                   |
| `approvals.*.status`                 | string  | sometimes, string                            |
| `approvals.*.approved_at`            | date    | nullable, date                               |

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Purchased Order updated successfully",
      "code": 200,
      "data": {
          // ... updated purchased order object ...
      }
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Purchased Order not found",
      "code": 404
  }
  ```

### `DELETE /api/purchased-orders/{id}`
Deletes a purchased order.

**Responses:**

* **200 OK (Success)**
  ```json
  {
      "message": "Purchased Order deleted successfully",
      "code": 200
  }
  ```
* **404 Not Found**
  ```json
  {
      "message": "Purchased Order not found",
      "code": 404
  }
  ```