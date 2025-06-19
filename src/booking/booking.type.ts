import { ObjectType, Field, Int } from '@nestjs/graphql';
import { HotelType } from '../hotel/hotel.type';

@ObjectType()
export class BookingType {
  @Field(() => Int)
  id: number;

  @Field()
  start_date: Date;

  @Field()
  end_date: Date;

  @Field(() => HotelType)
  hotel: HotelType;

  @Field(() => Int)
  hotel_id: number;

  @Field()
  is_checked_in: boolean;

  @Field()
  price: number;
}