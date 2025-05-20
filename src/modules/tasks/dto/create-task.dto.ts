import { IsString, IsNumber, IsOptional } from 'class-validator';

export class CreateTaskDto {
  @IsString()
  name: string;
  @IsString()
  description: string;

  @IsOptional()
  createdAt: Date;
  @IsOptional()
  completedAt: Date;

  @IsNumber()
  userId: number;
}
