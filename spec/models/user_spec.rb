require 'spec_helper'

describe User do
  describe '#role?' do
    context 'admin user' do
      let(:admin) { create(:admin) }

      it 'should be admin' do
        expect(admin.role?(:admin)).to be_true
      end
    end

    context 'normal user' do
      let(:user) { create(:user) }

      it 'should be normal user' do
        expect(user.role?(:admin)).to be_false
      end
    end
  end
end

