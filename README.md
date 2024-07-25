# Acme Widget Co POC

## Overview

This is proof of concept for the new sales system of acme widget co which implements a shopping basket system for their widgets. The system includes a product catalog, delivery charge rules, and special offer rules. It is designed to handle simple scenarios for managing a shopping basket and calculating the total cost with delivery charges and offers applied.

This can be improved further with more features.

## Product Catalog

Acme Widget Co sells three products:
- **Red Widget** (`R01`) - $32.95
- **Green Widget** (`G01`) - $24.95
- **Blue Widget** (`B01`) - $7.95

## Delivery Rules

Delivery costs are calculated based on the total basket value:
- Orders under $50 incur a delivery charge of $4.95.
- Orders from $50 to $89.99 incur a delivery charge of $2.95.
- Orders greater than or equal to $90 or more have free delivery.

## Offer Rules

The system implements the following offer:
- **Buy one Red Widget, get the second Red Widget at half price.**
- Let's assume this as Buy One Get Second Half Price which provides leverage where same offer csn be applied to other products.

## Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/shyamvegi/Thrive_Acme_Cart.git
   cd Thrive_Acme_Cart


### Running the Application

1. **Ensure PHPUnit Is Installed:**:
  PHPUnit,PHPStan should be installed via Composer. If not already installed, run:
   ```bash
   composer install

2. **Run PHPUnit Tests:**
    Run the PHPUnit tests to verify that the implementation works correctly. In the root directory of the project, execute:
    '''bash
    composer test

2. **Run Commands**

    '''bash
    composer install
    composer test


## Assumptions & Improvements

- **Offer Management**: The system currently supports only one type of offer. Additional offers would require modifications to the add OffersManager Class
 - Offers Can be Passed as Array of OfferType
 - currently assuming only one offer and if multiple offers are added it will apply eligible offers

    - What We can Do Further
    - We can manage Offers (CRUD)
    - Each Offer Can be configured Independently

- **Product Management**: Each product is identified by a unique code.
 - We can add products to catalog
 - We can find product by ID
 - Optimisation done using cache

    - What We can do further
    - We can make product not eligble for offer
    - We can do CRUD Operations on Products

- **Delivery Management**:
 - Provided Interface to create multiple Delivery Strategies
 - Implemented Threshold/Tiered Delivery Model.
 - Will Calculate delivery charge based on total coset

    - We can manager delivery strategies using common manager class
    - we can do crud operations.
    - we can configure each delivery strategy seperatley

- **Basket Management**:
 - Product catalog, Delivery Rules, Offer Rules can be configured to Basket using Basket Class
 - product can be added to basket along with quantity using add method.
 - Total Cost can be calculated using total method.
 - Throws Error if tried to add duplicate products

    - Independent configurations can be done for baskets
    - Crud operations can be implemented.

- **Test Cases/ Unit Testing**:
 - Setup includes the products creation, Offers Creation, Delivery Charges.
 - Did testing for all possible cases on Basket Management.

- **Calculations**:
 - Total Cost will round upto 2 digits.


## Potential Improvements

- Integrate logging to track operations and debug issues more effectively.
- Crud Operations can be added
- Complex logic can be handled on applying multiple offers.

## How the Given Rules Were Followed
- **Interfaces**: Interfaces has been created for
 - Offers
 - Delivery
 - Basket
 - Everything is well encapsulated


- **Product Catalogue**: The `Catalog` class manages and retrieves product details by their unique code.
- **Add Method**: The `add` method in the `Basket` class allows adding products to the basket by their code and quantiy of each product default is 1.
- **Total Calculation**:
  - **Offers**: The `Buy1GetSecondHalf` class applies the special offer for ProducCode Here (Red Widgets) during total calculation.
  - **Delivery Charges**: The `ThresholdDeliveryCharge` class calculates delivery charges based on the total value of the basket.
  - **Total**: The `total` method in the `Basket` class calculates
   - Calculates SubTotal
   - Applies Offers to get Discount
   - Then Applies DeliveryCharges on Total which leads the total cost of basket.
   - Rounded off to 2 digits 90.275 will be 90.27


## This Involves

- Composer
- PHPUnit (Unit and integration tests)
- PHPStan
- Docker
- Docker Compose
- Dependency Injection
- Strategy Pattern
- Sensible types
- Source control and code review - using git
- Good separation/encapsulation
- Modularity
- Small accurate interfaces - Basket, Offer, Delivery

